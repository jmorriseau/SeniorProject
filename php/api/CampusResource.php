<?php
/**
 * Class that contains the resources for making any changes to the database
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
     $message = campusResourceRun('GET', $id , NULL, $dbc);
     break;

   case 'POST':
     $data['campus_name'] = $_POST['campusName'];
     $check = dataCheck($data);
     if($check === true){
       $message = campusResourceRun('POST', NULL, $data, $dbc);
     }
     else{ $message = $check;}
     break;

   case 'PUT':
    parse_str(file_get_contents('php://input'), $put);
     $data['campus_name'] = $put['campusName'];
     $id = $put['id'];
     $check = dataCheck($data);
     if($check === true){
       $message = campusResourceRun('PUT', $id, $data, $dbc);
     }
     else{ $message = $check;}
     break;

   case 'DELETE':
     $id = $_GET['id'];
     $message = campusResourceRun('DELETE', $id, NULL, $dbc);
     break;
 }

 echo json_encode($message);
 /*
 * API Resources Function for Buildings
 * REST SERVER CALLS FOR BUILDING RESOURCES
 */

 function campusResourceRun($verb, $id = NULL ,$inputData = NULL, $db){
 $returnMessage;
 //$buildingResource = new BuildingResource($db);
 if ( 'GET' === $verb ) {
     if ( NULL === $id ) {
       $returnMessage = getAll($db);
     } else {
       $returnMessage = get($id,$db);
     }
 }

 if ( 'POST' === $verb ) {

     if ($inputData === NULL) {
         throw new Exception('Campus could not be added');
     } else {
         $returnMessage = post($inputData,$db);
     }
 }

 if ( 'PUT' === $verb ) {
     //if put is the verb, check the ID. If null, throw an exception looking for a id.
     if ( NULL === $id && $inputData === NULL) {
         throw new InvalidArgumentException('Campus ID ' . $id . ' was not found');
     } else {
         //if not, run the put function and set the message to the return.
         $returnMessage = put($id,$inputData,$db);
     }
 }

 if ('DELETE' === $verb) {
     //if the delete verb is selected, check the the id is not null, and if so, throw an exception.
     if ( NULL === $id ) {
         throw new InvalidArgumentException('Campus ID ' . $id . ' was not found');
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
      return  $db->sql("SELECT * FROM Campus");

  }

  function get($id,$db) {
      //Creates statement used to get specific entry from the database based on an id given via endpoint
      return $db->sql("SELECT * FROM Campus where campus_id = '".$id ."'");

  }


  function post($data,$db)
  {
      //Setups up the insert for SQL for post function as well as binding JSON data provided by the data array to the statement

      try{
          $db->sql("INSERT INTO Campus (
            campus_name)
            VALUES(
          '" .$data['campus_name']. "'
          );");
          return 'Campus Added';

      }
      catch(Exception $e){
          throw new Exception('Campus could not be added');
      }

  }
  function put($id,$data,$db)
  {
      //Put function uses a statement written to update a pre-existing db entry.
      try {
          $db->sql("Update Campus SET campus_name ='" .$data['campus_name'] .
              "' WHERE campus_id = '" . $id . "'");
          return 'Campus Updated';
      } catch (Exception $e){
          throw new Exception('Campus could not be updated');
      }
  }


  function delete($id,$db) {
      //Delete uses a statement written to delete from the db where the id matches the one located in the endpoint.
      $db->sql("DELETE FROM Campus WHERE campus_id = '".$id."';");

      if($db->sql("select * from Campus where campus_id ='".$id."';").length == 0) {
          return 'Campus Deleted';
      } else {
          throw new InvalidArgumentException('Campus ID ' . $id . ' was not found');
      }
  }

  function dataCheck($data) {
      //The dataCheck function uses the JSON data to make sure that all form objects were properly filled out.
      $errors = array();

      if ($data['campus_name'] === '' ){
          $errors[] = 'No Campus Name ';
      } else {
        if(preg_match('/^[a-zA-Z 0-9]*$/', $data['campus_name'])){
        } else {
          $errors[] = 'Campus Name in the wrong format';
        }
      }
      if (count($errors) > 0)
      {
        $message = 'ERRORS: ';
        foreach($errors as $error){
          $message = $message . $error . ' ';
        }
        return $message;
      }
      else{
          return true;
      }
  }
