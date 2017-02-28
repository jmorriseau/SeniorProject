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
     $message = facultyResourceRun('GET', $id , NULL, $dbc);
     break;

   case 'POST':
     $data['first_name'] = $_POST['firstName'];
     $data['last_name'] = $_POST['lastName'];
     $data['phone_number'] = $_POST['phoneNumber'];
     $data['email'] = $_POST['email'];
     if(dataCheck($data)){
       $message = facultyResourceRun('POST', NULL, $data, $dbc);
     }
     else{ $message = "Data not in correct format";}
     break;

   case 'PUT':
    parse_str(file_get_contents('php://input'), $put);
    $data['first_name'] = $put['firstName'];
    $data['last_name'] = $put['lastName'];
    $data['phone_number'] = $put['phoneNumber'];
    $data['email'] = $put['email'];
    $id = $put['id'];
    if(dataCheck($data)){
      $message = facultyResourceRun('PUT', $id, $data, $dbc);
    }
    else{ $message = "Data not in correct format";}
    break;

   case 'DELETE':
     $id = $_GET['id'];
     $message = facultyResourceRun('DELETE', $id, NULL, $dbc);
     break;
 }

 echo json_encode($message);
 /*
 * API Resources Function for Buildings
 * REST SERVER CALLS FOR CORUSE RESOURCES
 */

 function facultyResourceRun($verb, $id = NULL ,$inputData = NULL, $db){
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
         throw new Exception('Faculty could not be added');
     } else {
         $returnMessage = post($inputData,$db);
     }
 }

 if ( 'PUT' === $verb ) {
     //if put is the verb, check the ID. If null, throw an exception looking for a id.
     if ( NULL === $id && $inputData === NULL) {
         throw new InvalidArgumentException('Faculty ID ' . $id . ' was not found');
     } else {
         //if not, run the put function and set the message to the return.
         $returnMessage = put($id,$inputData,$db);
     }
 }

 if ('DELETE' === $verb) {
     //if the delete verb is selected, check the the id is not null, and if so, throw an exception.
     if ( NULL === $id ) {
         throw new InvalidArgumentException('Faculty ID ' . $id . ' was not found');
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
        return $db->sql("SELECT * FROM Faculty");
        //return $this->db;
    }

     function get($id, $db) {
        //Creates statement used to get specific entry from the database based on an id given via endpoint
        return $db->sql("SELECT * FROM Faculty where faculty_id ='".$id ."'");
    }

     function post($data,$db)
    {
        //Setups up the insert for SQL for post function as well as binding JSON data provided by the data array to the statement
        //return 'yay';
        try{
           $db->sql("INSERT INTO Faculty (
             first_name ,last_name, phone_number, email)
             VALUES(
           '" .$data['first_name']. "'
           , '" .$data['last_name']. "'
           , '" .$data['phone_number']. "'
           , '" .$data['email']. "')
          ;");

          return 'Faculty Added';
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
          $db->sql("UPDATE Faculty SET
            first_name = '". $data['first_name'] . "'
          , last_name = '" . $data['last_name'] . "'
          , phone_number = '" . $data['phone_number'] . "'
          , email = '" . $data['email'] . "'
          WHERE faculty_id = '" .$id. "'");
          return 'Faculty Updated';
        } catch (Exception $e){
                throw new Exception('Faculty could not be updated');
        }
    }

     function delete($id,$db) {
        //Delete uses a statment written to delete from the db where the id matches the one located in the endpoint.
        $db->sql("DELETE FROM Faculty WHERE faculty_id = '".$id."';");

        if($db->sql("SELECT * from Faculty where faculty_id ='".$id."';").length == 0)
        {
          return "Faculty Deleted";
        }  else {
          return "Error Faculty not Deleted";
        }

    }

    function dataCheck($data) {
        //The dataCheck function uses the JSON data to make sure that all form objects were properly filled out.
        $errors = array();

        if ($data['first_name'] === '' ){
          if(preg_match('/^[a-zA-Z 0-9]*$/', $data['first_name'])){
            $errors[] = 'First Name in the wrong format';
          } else {
            $errors[] = 'No First Name ';
          }
        }
        if ($data['last_name'] === '' ){
          if(preg_match('/^[a-zA-Z 0-9]*$/', $data['last_name'])){
            $errors[] = 'Last Name in the wrong format';
          } else {
            $errors[] = 'No Last Name ';
          }
        }
        if ($data['phone_number'] === '' ){
          if(preg_match('/^(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$/', $data['phone_number'])){
            $errors[] = 'Phone Number in the wrong format';
          } else {
            $errors[] = 'No Phone Number ';
          }
        }
        if ($data['email'] === '' ){
          if(preg_match('/^[A-Za-z0-9@.]*$/', $data['email'])){
            $errors[] = 'Email in the wrong format';
          } else {
            $errors[] = 'No Email ';
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
