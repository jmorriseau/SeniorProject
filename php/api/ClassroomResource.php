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
   $message = classroomResourceRun('GET', $id , NULL, $dbc);
   break;

 case 'POST':

   $data['building_id'] = $_POST['buildingId'];
<<<<<<< HEAD
   $data['class_number'] = $_POST['roomNumber'];
   $data['room_type_id'] = $_POST['classroomTypeId'];
   $data['capacity'] = $_POST['roomCap'];
   //if(dataCheck($data)){
=======
   $data['class_number'] = $_POST['classNumber'];
   $data['room_type_id'] = $_POST['roomTypeId'];
   $data['capacity'] = $_POST['capacity'];
   if(dataCheck($data)){
>>>>>>> 741783c3eefcfda3075529f9f47c49280f58f9e5
     $message = classroomResourceRun('POST', NULL, $data, $dbc);
   //}
   //else{ $message = "Data not in correct format";}
   break;

 case 'PUT':
  parse_str(file_get_contents('php://input'), $put);
   $data['building_id'] = $put['buildingId'];
   $data['room_type_id'] = $put['roomTypeId'];
   $data['class_number'] = $put['classNumber'];
   $data['capacity'] = $put['capacity'];
   $id = $put['id'];
   //echo "<script>console.log( 'Debug Objects: " . $data['building_id'] . '\t' . $data['room_type_id'] . '\t' . $data['class_number'] . '\t' . $data['capacity'] . '\t'. "' );</script>";
   //if(dataCheck($data)){
     $message = classroomResourceRun('PUT', $id, $data, $dbc);
   //}
   //else{ $message = "Data not in correct format";}
   break;

 case 'DELETE':
   $id = $_GET['id'];
   $message = classroomResourceRun('DELETE', $id, NULL, $dbc);
   break;
}

echo json_encode($message);
/*
* API Resources Function for Buildings
* REST SERVER CALLS FOR BUILDING RESOURCES
*/

function classroomResourceRun($verb, $id = NULL, $inputData = NULL, $db){
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

    try{
       $db->sql("INSERT INTO Classroom (
         building_id, room_type_id, class_number, capacity)
         VALUES(
       '" .$data['building_id']. "',
       '" .$data['room_type_id']. "',
       '" .$data['class_number']. "',
       '" .$data['capacity']. "' )
      ;");
      return 'Classroom Added';
    }
    catch(Exception $e){
      //return new Exception($e);
      //return 'INSERT not accepted';
      return $e->getMessage();
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

function dataCheck($data) {
    //The dataCheck function uses the JSON data to make sure that all form objects were properly filled out.
    $errors = array();

    if ($data['building_id'] === '' ){
        $errors[] = 'No Building ID ';
    } else {
      if(preg_match('/^[0-9]*$/', $data['building_id'])){
      } else {
        $errors[] = 'Building ID in the wrong format';
      }
    }
    if ($data['room_type_id'] === '' ){
        $errors[] = 'No Room Type ID ';
    } else {
      if(preg_match('/^[0-9]*$/', $data['room_type_id'])){
      } else {
        $errors[] = 'Room Type ID in the wrong format';
      }
    }
    if ($data['class_number'] === '' ){
        $errors[] = 'No Classroom Number ';
    } else {
      if(preg_match('/^[a-zA-Z 0-9]*$/', $data['class_number'])){
      } else {
        $errors[] = 'Classroom Number in the wrong format';
      }
    }
    if ($data['capacity'] === '' ){
        $errors[] = 'No Capacity ';
    } else {
      if(preg_match('/^[0-9]*$/', $data['capacity'])){
      } else {
        $errors[] = 'Capacity in the wrong format';
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
