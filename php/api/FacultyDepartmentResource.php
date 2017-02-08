<?php
/**
 * Class that contains the resources for making any changes to the 'Building' table in the database.
 *
 * @author Mike
 */

 header('Content-type: application/json');
 include('../autoload.php');

 $data = array();
 $dbc = new DAO();

 $success = true;
 $response_array['status'] = 'success';
 $db_success = '';
 $err_msg = '';
 $message;

 switch($_SERVER['REQUEST_METHOD']){
   case 'GET':
     $id;
     if($_POST['id'] === ''){
       $id = NULL;
     }
     else{
       $id = $_POST['id'];
     }
     $message = facultyDeptResourceRun('GET', $id , NULL, $dbc);
     break;

   case 'POST':
     $data['faculty_id'] = $_POST['facultyId'];
     $data['departments_id'] = $_POST['departmentsId'];
     $message = facultyDeptResourceRun('POST', NULL, $data, $dbc);
     break;

   case 'PUT':
    $data['faculty_id'] = $_POST['facultyId'];
    $data['departments_id'] = $_POST['departmentsId'];
    $id = $_POST['id'];
    $message = facultyDeptResourceRun('PUT', $id, $data, $dbc);
    break;

   case 'DELETE':
     $id = $_POST['id'];
     $message = facultyDeptResourceRun('DELETE', $id, NULL, $dbc);
     break;
 }

 echo json_encode($message);
 /*
 * API Resources Function for Buildings
 * REST SERVER CALLS FOR CORUSE RESOURCES
 */

 function facultyDeptResourceRun($verb, $id = NULL ,$inputData = NULL, $db){
 $returnMessage;

 if ( 'GET' === $verb ) {
     if ( NULL === $id ) {
       $returnMessage = getAll($db);
     } else {
       $returnMessage = get($id,$db);
     }
 }

 if ( 'POST' === $verb ) {

     if ($inputData === NULL) {
         throw new Exception('Faculty Department Relation could not be added');
     } else {
         $returnMessage = post($inputData,$db);
     }
 }

 if ( 'PUT' === $verb ) {
     //if put is the verb, check the ID. If null, throw an exception looking for a id.
     if ( NULL === $id && $inputData === NULL) {
         throw new InvalidArgumentException('Faculty Department Relation ID ' . $id . ' was not found');
     } else {
         //if not, run the put function and set the message to the return.
         $returnMessage = put($id,$inputData,$db);
     }
 }

 if ('DELETE' === $verb) {
     //if the delete verb is selected, check the the id is not null, and if so, throw an exception.
     if ( NULL === $id ) {
         throw new InvalidArgumentException('Faculty Department Relation ID ' . $id . ' was not found');
     } else {
         // if its all clear, set the message to the delete function return.
       $returnMessage = delete($id,$db);
     }
 }
 // IMPORTANT!!! Return coming up.
 return $returnMessage;
 }

     function getAll($db) {
        //Very similar statement to get(), except this function requires no parameters and returns all entries in the db.
        return $db->sql("SELECT Faculty_Dept_Relation.faculty_dept_relation_id, Faculty_Dept_Relation.faculty_id,  Departments.department_name FROM Faculty_Dept_Relation, Departments WHERE Faculty_Dept_Relation.departments_id = Departments.departments_id");
        //return $this->db;
    }

     function get($id, $db) {
        //Creates statement used to get specific entry from the database based on an id given via endpoint
        return $db->sql("SELECT Faculty_Dept_Relation.faculty_dept_relation_id, Faculty_Dept_Relation.faculty_id,  Departments.department_name FROM Faculty_Dept_Relation, Departments WHERE Faculty_Dept_Relation.departments_id = Departments.departments_id AND faculty_id ='".$id ."'");
    }

     function post($data,$db)
    {
        //Setups up the insert for SQL for post function as well as binding JSON data provided by the data array to the statement
        //return 'yay';
        try{
           $db->sql("INSERT INTO Faculty_Dept_Relation (
             faculty_id ,departments_id)
             VALUES(
           '" .$data['faculty_id']. "'
           , '" .$data['departments_id']. "')
          ;");

          return 'Faculty Department Relation Added';
        }
        catch(Exception $e){
          //return new Exception($e);
          return $e;
        }

    }


     function put($id,$data,$db)
    {
        //Put function uses a statement written to update a pre-existing db entry.
        try {
          $db->sql("UPDATE Faculty_Dept_Relation SET
            faculty_id = '" .$data['faculty_id'] ."'
          , departments_id = '". $data['departments_id'] . "'
          WHERE faculty_dept_relation_id = '" .$id. "'");
          return 'Faculty Department Relation Updated';
        } catch (Exception $e){
                throw new Exception('Faculty Department Relation could not be updated');
        }
    }

     function delete($id,$db) {
        //Delete uses a statment written to delete from the db where the id matches the one located in the endpoint.
        $db->sql("DELETE FROM Faculty_Dept_Relation WHERE faculty_dept_relation_id = '".$id."';");

        if($db->sql("SELECT * from Faculty_Dept_Relation where faculty_dept_relation_id ='".$id."';").length == 0)
        {
          return "Faculty Department Relation Deleted";
        }  else {
          return "Error Faculty Department Relation not Deleted";
        }

    }
