<?php
/**
* Class that contains the resources for making any changes to the 'Curriculum' table in the database.
*
* @author Joshua
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
    $message = curriculumResourceRun('GET', $id , NULL, $dbc);
    break;

  case 'POST':
    $data['department_id'] = $_POST['departmentID'];
    $data['curriculum_name'] = $_POST['curriculumName'];
    $data['degree_type_id'] = $_POST['degreeTypeId'];
    $data['start_term'] = $_POST['startTerm'];
    $data['end_term'] = $_POST['endTerm'];
    $check = dataCheck($data);
    if($check === true){
      $message = curriculumResourceRun('POST', NULL, $data, $dbc);
    }
    else{ $message = $check;}
    break;

  case 'PUT':
    parse_str(file_get_contents('php://input'), $put);
    $data['department_id'] = $put['departmentID'];
    $data['curriculum_name'] = $put['curriculumName'];
    $data['degree_type_id'] = $put['degreeTypeId'];
    $data['start_term'] = $put['startTerm'];
    $data['end_term'] = $put['endTerm'];
    $id = $put['id'];
    $check = dataCheck($data);
    if($check === true){
      $message = curriculumResourceRun('PUT', $id, $data, $dbc);
    }
    else{ $message = $check;}
    break;

  case 'DELETE':
    $id = $_GET['id'];
    $message = curriculumResourceRun('DELETE', $id, NULL, $dbc);
    break;
}

echo json_encode($message);
/*
* API Resources Function for Buildings
* REST SERVER CALLS FOR BUILDING RESOURCES
*/

function curriculumResourceRun($verb, $id = NULL ,$inputData = NULL, $db){
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
        throw new Exception('Curriculum could not be added');
    } else {
        $returnMessage = post($inputData,$db);
    }
}

if ( 'PUT' === $verb ) {
    //if put is the verb, check the ID. If null, throw an exception looking for a id.
    if ( NULL === $id && $inputData === NULL) {
        throw new InvalidArgumentException('Curriculum ID ' . $id . ' was not found');
    } else {
        //if not, run the put function and set the message to the return.
        $returnMessage = put($id,$inputData,$db);
    }
}

if ('DELETE' === $verb) {
    //if the delete verb is selected, check the the id is not null, and if so, throw an exception.
    if ( NULL === $id ) {
        throw new InvalidArgumentException('Curriculum ID ' . $id . ' was not found');
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
    return $db->sql("SELECT Curriculum.curriculum_id, Curriculum.department_id, Curriculum.curriculum_name, Curriculum.degree_type_id, Degree_Types.degree_type_name, Curriculum.start_term, Curriculum.end_term FROM Curriculum, Degree_Types WHERE Curriculum.degree_type_id = Degree_Types.degree_type_id;");
    //return $this->db;
}

function get($id,$db) {
    //Creates statement used to get specific entry from the database based on an id given via endpoint
    return $db->sql("SELECT Curriculum.curriculum_id, Curriculum.department_id, Curriculum.curriculum_name, Curriculum.degree_type_id, Degree_Types.degree_type_name, Curriculum.start_term, Curriculum.end_term FROM Curriculum, Degree_Types WHERE Curriculum.degree_type_id = Degree_Types.degree_type_id AND curriculum_id ='".$id ."'");
}

function post($data,$db)
{
    //Setups up the insert for SQL for post function as well as binding JSON data provided by the data array to the statement
    //return 'yay';
    try{
       $db->sql("INSERT INTO Curriculum (
         department_id, curriculum_name, degree_type_id, start_term, end_term)
         VALUES(
       '" .$data['department_id']. "',
       '" .$data['curriculum_name']. "',
       '" .$data['degree_type_id']. "',
       '" .$data['start_term']. "',
       '" .$data['end_term']. "')
      ;");

      return 'Curriculum Added';
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
    $db->sql("UPDATE Curriculum SET
      department_id = '" .$data['department_id'] ."'
    , curriculum_name = '". $data['curriculum_name'] . "'
    , degree_type_id = '" . $data['degree_type_id'] . "'
    , start_term = '" . $data['start_term'] . "'
    , end_term = '" . $data['end_term'] . "'
    WHERE curriculum_id = '" .$id. "'");
    return 'Curriculum Updated';
  } catch (Exception $e){
          throw new Exception('Curriculum could not be updated');
  }
}

function delete($id,$db) {
  //Delete uses a statment written to delete from the db where the id matches the one located in the endpoint.
  $db->sql("DELETE FROM Curriculum WHERE curriculum_id = '".$id."';");

  if($db->sql("select * from Curriculum where curriculum_id ='".$id."';").length == 0)
  {
    return "Curriculum Deleted";
  }  else {
    return "Error Curriculum not Deleted";
  }
}

function dataCheck($data) {
    //The dataCheck function uses the JSON data to make sure that all form objects were properly filled out.
    $errors = array();

    if ($data['department_id'] === '' ){
        $errors[] = 'No Department ID ';
    } else {
      if(preg_match('/^[0-9]*$/', $data['department_id'])){
      } else {
        $errors[] = 'Department ID in the wrong format';
      }
    }
    if ($data['curriculum_name'] === '' ){
        $errors[] = 'No Curriculum Name ';
    } else {
      if(preg_match('/^[a-zA-Z 0-9]*$/', $data['curriculum_name'])){
      } else {
        $errors[] = 'Curriculum Name in the wrong format';
      }
    }
    if ($data['degree_type_id'] === '' ){
        $errors[] = 'No Degree Type ID ';
    } else {
      if(preg_match('/^[0-9]*$/', $data['degree_type_id'])){
      } else {
        $errors[] = 'Degree Type ID in the wrong format';
      }
    }
    if ($data['start_term'] === '' ){
        $errors[] = 'No Start Term ';
    } else {
      if(preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $data['start_term'])){
      } else {
        $errors[] = 'Start Term in the wrong format';
      }
    }
    if ($data['end_term'] === '' ){
        $errors[] = 'No End Term ';
    } else {
      if(preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $data['end_term'])){
      } else {
        $errors[] = 'End Term in the wrong format';
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
