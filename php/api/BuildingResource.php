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
    $message = buildingResourceRun('GET', $id , NULL, $dbc);
    break;

  case 'POST':
    $data['campus_id'] = $_POST['campusName'];
    $data['building_abbreviation'] = 'TS';
    $data['building_name'] = $_POST['buildingName'];
    $data['address'] = $_POST['addressLine1'];
    $data['city'] = $_POST['city'];
    $data['state'] = $_POST['state'];
    $data['zip'] = $_POST['zip'];
    $check = dataCheck($data);
    if($check === true){
      $message = buildingResourceRun('POST', NULL, $data, $dbc);
    }
    else{ $message = $check;}
    break;

  case 'PUT':
    parse_str(file_get_contents('php://input'), $put);
    $data['campus_id'] = $put['campusName'];
    $data['building_abbreviation'] = 'TS';
    $data['building_name'] = $put['buildingName'];
    $data['address'] = $put['addressLine1'];
    $data['city'] = $put['city'];
    $data['state'] = $put['state'];
    $data['zip'] = trim($put['zip']);
    $id = $put['id'];
    $check = dataCheck($data);
    if($check === true){
      $message = buildingResourceRun('PUT', $id, $data, $dbc);
    }
    else{ $message = $check;}
    break;

  case 'DELETE':
    $id = $_GET['id'];
    $message = buildingResourceRun('DELETE', $id, NULL, $dbc);
    break;
}

echo json_encode($message);

/*
* API Resources Function for Buildings
* REST SERVER CALLS FOR BUILDING RESOURCES
*/

function buildingResourceRun($verb, $id = NULL ,$inputData = NULL, $db){
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
        throw new Exception('Building could not be added');
    } else {
        $returnMessage = post($inputData,$db);
    }
}

if ( 'PUT' === $verb ) {
    //if put is the verb, check the ID. If null, throw an exception looking for a id.
    if ( NULL === $id && $inputData === NULL) {
        throw new InvalidArgumentException('Building ID ' . $id . ' was not found');
    } else {
        //if not, run the put function and set the message to the return.
        $returnMessage = put($id,$inputData,$db);
    }
}

if ('DELETE' === $verb) {
    //if the delete verb is selected, check the the id is not null, and if so, throw an exception.
    if ( NULL === $id ) {
        throw new InvalidArgumentException('Building ID ' . $id . ' was not found');
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
    return $db->sql("SELECT * FROM Building");
    //return $this->db;
}
function get($id,$db) {
    //Creates statement used to get specific entry from the database based on an id given via endpoint
    return $db->sql("SELECT * FROM Building where building_id ='".$id ."'");
}
function post($data, $db)
{
    //Setups up the insert for SQL for post function as well as binding JSON data provided by the data array to the statement
    //return 'yay';
    try{
       $db->sql("INSERT INTO Building (
         campus_id, building_abbreviation, building_name, address, city, state, zip)
         VALUES(
       '" .$data['campus_id']. "',
       '" .$data['building_abbreviation']. "',
       '" .$data['building_name']. "',
       '" .$data['address']. "',
       '" .$data['city']. "',
       '" .$data['state']. "',
       '" .$data['zip']. "' )
      ;");
      return 'Building Added';
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
      $db->sql("UPDATE Building SET
        campus_id = '" .$data['campus_id'] ."'
      , building_name = '". $data['building_name'] . "'
      , building_abbreviation = '" . $data['building_abbreviation'] . "'
      , address = '" . $data['address'] . "'
      , city = '" . $data['city'] . "'
      , state = '" . $data['state'] . "'
      , zip = '" . $data['zip'] . "'
      WHERE building_id = '" .$id. "'");
      return 'Building Updated';
    } catch (Exception $e){
            throw new Exception('Building could not be updated');
    }
}
function delete($id,$db) {
    //Delete uses a statment written to delete from the db where the id matches the one located in the endpoint.
    if(sizeof($db->sql("SELECT * from Classroom where building_id ='".$id."';")) > 0)
    {
      $db->sql("DELETE from Classroom where building_id = '".$id."';");
    }

    $db->sql("DELETE FROM Building WHERE building_id = '".$id."';");

    if(sizeof($db->sql("select * from Building where building_id ='".$id."';")) == 0)
    {
      return "Building Deleted";
    }  else {
      return "Error Building not Deleted";
    }
}

function dataCheck($data) {
    //The dataCheck function uses the JSON data to make sure that all form objects were properly filled out.
    $errors = array();

    if ($data['campus_id'] === '' ){
        $errors[] = 'No Campus ID ';
    } else {
      if(preg_match('/^[0-9]*$/', $data['campus_id'])){
      } else {
        $errors[] = 'Campus ID in the wrong format';
      }
    }

    if ($data['building_abbreviation'] === '' ){
        $errors[] = 'No Building Abbreviation ';
    } else {
      if(preg_match('/^[a-zA-Z 0-9]*$/', $data['building_abbreviation'])){
      } else {
        $errors[] = 'Building Abbreviation in the wrong format';
      }
    }

    if ($data['building_name'] === '' ){
        $errors[] = 'No Building Name ';
    } else {
      if(preg_match('/^[a-zA-Z 0-9]*$/', $data['building_name'])){
      } else {
        $errors[] = 'Building Name in the wrong format';
      }
    }

    if ($data['address'] === '' ){
        $errors[] = 'No Address ';
    } else {
      if(preg_match('/^[a-zA-Z 0-9]*$/', $data['address'])){
      } else {
        $errors[] = 'Address in the wrong format';
      }
    }

    if ($data['city'] === '' ){
        $errors[] = 'No City ';
    } else {
      if(preg_match('/.*/', $data['city'])){
      } else {
        $errors[] = 'City in the wrong format';
      }
    }

    if ($data['state'] === '' ){
        $errors[] = 'No State ';
    } else {
      if(preg_match('/^[A-Z]{2}$/', $data['state'])){
      } else {
        $errors[] = 'State in the wrong format';
      }
    }

    if ($data['zip'] === '' ){
        $errors[] = 'No Zip ';
    } else {
      if(preg_match('/^\d{5}(?:[-\s]\d{4})?$/', $data['zip'])){
      } else {
        $errors[] = 'Zip in the wrong format';
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
