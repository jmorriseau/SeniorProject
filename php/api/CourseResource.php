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
     if($_GET['id'] === ''){
       $id = NULL;
     }
     else{
       $id = $_GET['id'];
     }
     $message = courseResourceRun('GET', $id , NULL, $dbc);
     break;

   case 'POST':
     $data['course_name'] = $_POST['courseName'];
     $data['course_number'] = $_POST['courseNumber'];
     $data['credit_hours'] = $_POST['creditHours'];
     $data['semester_number'] = $_POST['semesterNumber'];
     $data['departments_id'] = $_POST['departmentsId'];
     if(dataCheck($data)){
       $message = courseResourceRun('POST', NULL, $data, $dbc);
     }
     else{ $message = "Data not in correct format";}
     break;

   case 'PUT':
    parse_str(file_get_contents('php://input'), $put);
    $data['course_name'] = $put['courseName'];
    $data['course_number'] = $put['courseNumber'];
    $data['credit_hours'] = $put['creditHours'];
    $data['semester_number'] = $put['semesterNumber'];
    $data['departments_id'] = $put['departmentsId'];
    $id = $put['id'];
    if(dataCheck($data)){
      $message = courseResourceRun('PUT', $id, $data, $dbc);
    }
    else{ $message = "Data not in correct format";}
    break;

   case 'DELETE':
     $id = $_GET['id'];
     $message = courseResourceRun('DELETE', $id, NULL, $dbc);
     break;
 }

 echo json_encode($message);
 /*
 * API Resources Function for Buildings
 * REST SERVER CALLS FOR CORUSE RESOURCES
 */

 function courseResourceRun($verb, $id = NULL ,$inputData = NULL, $db){
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
         throw new Exception('Course could not be added');
     } else {
         $returnMessage = post($inputData,$db);
     }
 }

 if ( 'PUT' === $verb ) {
     //if put is the verb, check the ID. If null, throw an exception looking for a id.
     if ( NULL === $id && $inputData === NULL) {
         throw new InvalidArgumentException('Course ID ' . $id . ' was not found');
     } else {
         //if not, run the put function and set the message to the return.
         $returnMessage = put($id,$inputData,$db);
     }
 }

 if ('DELETE' === $verb) {
     //if the delete verb is selected, check the the id is not null, and if so, throw an exception.
     if ( NULL === $id ) {
         throw new InvalidArgumentException('Course ID ' . $id . ' was not found');
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
        return $db->sql("SELECT * FROM Courses");
        //return $this->db;
    }

     function get($id, $db) {
        //Creates statement used to get specific entry from the database based on an id given via endpoint
        return $db->sql("SELECT * FROM Courses where course_id ='".$id ."'");
    }

     function post($data,$db)
    {
        //Setups up the insert for SQL for post function as well as binding JSON data provided by the data array to the statement
        //return 'yay';
        try{
           $db->sql("INSERT INTO Courses (
             course_name, course_number, credit_hours, semester_number, departments_id)
             VALUES(
           '" .$data['course_name']. "',
           '" .$data['course_number']. "',
           '" .$data['credit_hours']. "',
           '" .$data['semester_number']. "',
            '" .$data['departments_id']. "')
          ;");

          return 'Course Added';
        }
        catch(Exception $e){
          //return new Exception($e);
          return $e->getMessage();
        }

    }


     function put($id,$data,$db)
    {
        //Put function uses a statement written to update a pre-existing db entry.
        try {
          $db->sql("UPDATE Courses SET
            course_name = '" .$data['course_name'] ."'
          , course_number = '". $data['course_number'] . "'
          , credit_hours = '" . $data['credit_hours'] . "'
          , semester_number = '" . $data['semester_number'] . "'
          , departments_id = '" . $data['departments_id'] . "'
          WHERE course_id = '" .$id. "'");
          return 'Course Updated';
        } catch (Exception $e){
                throw new Exception('Course could not be updated');
        }
    }

     function delete($id,$db) {
        //Delete uses a statment written to delete from the db where the id matches the one located in the endpoint.
        $db->sql("DELETE FROM Courses WHERE course_id = '".$id."';");

        if($db->sql("SELECT * from Courses where course_id ='".$id."';").length == 0)
        {
          return "Course Deleted";
        }  else {
          return "Error Course not Deleted";
        }

    }

function dataCheck($data) {
    //The dataCheck function uses the JSON data to make sure that all form objects were properly filled out.
    $errors = array();

    if ($data['course_name'] === '' ){
      if(preg_match('/^[a-zA-Z 0-9]*$/', $data['course_name'])){
        $errors[] = 'Course Name in the wrong format';
      } else {
        $errors[] = 'No Course Name ';
      }
    }
    if ($data['course_number'] === '' ){
      if(preg_match('/^[a-zA-Z 0-9]*$/', $data['course_number'])){
        $errors[] = 'Course Number in the wrong format';
      } else {
        $errors[] = 'No Course Number ';
      }
    }
    if ($data['credit_hours'] === '' ){
      if(preg_match('/^[0-9]*$/', $data['credit_hours'])){
        $errors[] = 'Credit Hours in the wrong format';
      } else {
        $errors[] = 'No Credit Hours ';
      }
    }
    if ($data['semester_number'] === '' ){
      if(preg_match('/^[0-9]*$/', $data['semester_number'])){
        $errors[] = 'Semester Number in the wrong format';
      } else {
        $errors[] = 'No Semester Number ';
      }
    }
    if ($data['departments_id'] === '' ){
      if(preg_match('/^[0-9]*$/', $data['departments_id'])){
        $errors[] = 'Department ID in the wrong format';
      } else {
        $errors[] = 'No Department ID ';
      }
    }
    if (count($errors) > 0)
    {
        throw new Exception('Form not fully filled');
    }
    else{
        return true;
    }
}
