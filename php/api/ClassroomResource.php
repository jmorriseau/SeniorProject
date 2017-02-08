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
   $message = classroomResourceRun('GET', $id , NULL, $dbc);
   break;

 case 'POST':
   $data['building_id'] = $_POST['buildingId'];
   $data['room_type_id'] = $_POST['roomTypeId'];
   $data['class_number'] = $_POST['classNumber'];
   $data['capacity'] = $_POST['capacity'];
   $message = classroomResourceRun('POST', NULL, $data, $dbc);
   break;

 case 'PUT':
   $data['building_id'] = $_POST['buildingId'];
   $data['room_type_id'] = $_POST['roomTypeId'];
   $data['class_number'] = $_POST['classNumber'];
   $data['capacity'] = $_POST['capacity'];
   $id = $_POST['id'];
   $message = classroomResourceRun('PUT', $id, $data, $dbc);
   break;

 case 'DELETE':
   $id = $_POST['id'];
   $message = classroomResourceRun('DELETE', $id, NULL, $dbc);
   break;
}

echo json_encode($message);
/*
* API Resources Function for Buildings
* REST SERVER CALLS FOR BUILDING RESOURCES
*/

function classroomResourceRun($verb, $id = NULL ,$inputData = NULL, $db){
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
         throw new Exception('Classroom could not be added');
     } else {
         $returnMessage = post($inputData,$db);
     }
  }

  if ( 'PUT' === $verb ) {
     //if put is the verb, check the ID. If null, throw an exception looking for a id.
     if ( NULL === $id && $inputData === NULL) {
         throw new InvalidArgumentException('Classroom ID ' . $id . ' was not found');
     } else {
         //if not, run the put function and set the message to the return.
         $returnMessage = put($id,$inputData,$db);
     }
  }

  if ('DELETE' === $verb) {
     //if the delete verb is selected, check the the id is not null, and if so, throw an exception.
     if ( NULL === $id ) {
         throw new InvalidArgumentException('Classroom ID ' . $id . ' was not found');
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
    return $db->sql("SELECT * FROM Classroom");
    //return $this->db;
}

function get($id,$db) {
    //Creates statement used to get specific entry from the database based on an id given via endpoint
    return $db->sql("SELECT * FROM Classroom where classroom_id ='".$id ."'");
}

function post($data,$db)
{
    //Setups up the insert for SQL for post function as well as binding JSON data provided by the data array to the statement
    //return 'yay';
    try{
       $db->sql("INSERT INTO Classroom (
         building_id, room_type_id, class_number, capacity)
         VALUES(
       '" .$data['building_id']. "',
       '" .$data['room_type_id']. "',
       '" .$data['class_number']. "',
       '" .$data['capacity']. "')
      ;");

      return 'Classroom Added';
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
      $db->sql("Update Classroom SET building_id ='" .$data['building_id'] ."'
      , room_type_id = '". $data['room_type_id'] . "'
      , class_number = '" . $data['class_number'] . "'
      , capacity = '" . $data['capacity'] . "'
      WHERE classroom_id = '" . $id . "'");
        return 'Classroom Updated';
    } catch (Exception $e){
            throw new Exception('Classroom could not be updated');
    }
}

function delete($id,$db) {
    //Delete uses a statment written to delete from the db where the id matches the one located in the endpoint.
    $db->sql("DELETE FROM Classroom WHERE classroom_id = '".$id."';");

    if($db->sql("select * from Classroom where classroom_id ='".$id."';").length == 0)
    {
      return "Classroom Deleted";
    }  else {
      return "Error Classroom not Deleted";
    }

}

    /*public function dataCheck($data) {
        //The dataCheck function uses the JSON data to make sure that all form objects were properly filled out.
        $errors = array();

        if ($data['campus_id'] === '' ){
            $errors[] = 'No Campus ID ';
        }
        if ($data['building_name'] === '' ){
            $errors[] = 'No Building Name ';
        }
        if ($data['building_abbreviation'] === '' ){
            $errors[] = 'No Abbreviation ';
        }
        if (count($errors) > 0)
        {
            throw new Exception('Form not fully filled');
        }
        else{
            return true;
        }

    }*/
