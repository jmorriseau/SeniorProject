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
   $message = classroomAttrResourceRun('GET', $id , NULL, $dbc);
   break;

 case 'POST':

    $data['attributes_id'] = $_POST['attributesId'];
    $data['classroom_id'] = $_POST['classroomId'];
    $check = dataCheck($data);
    if($check === true){
      $message = classroomAttrResourceRun('POST', NULL, $data, $dbc);
    }
    else{ $message = $check;}
    break;

 case 'PUT':
  parse_str(file_get_contents('php://input'), $put);
    $data['attributes_id'] = $put['attributesId'];
    $data['classroom_id'] = $put['classroomId'];
    $id = $put['id'];
    $check = dataCheck($data);
    if($check === true){
      $message = classroomAttrResourceRun('PUT', $id, $data, $dbc);
    }
    else{ $message = $check;}
    break;

 case 'DELETE':
   $id = $_GET['id'];
   $message = classroomAttrResourceRun('DELETE', $id, NULL, $dbc);
   break;
}

echo json_encode($message);
/*
* API Resources Function for Buildings
* REST SERVER CALLS FOR BUILDING RESOURCES
*/

function classroomAttrResourceRun($verb, $id = NULL, $inputData = NULL, $db){
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
         throw new Exception('Classroom Attribute could not be added');
     } else {
        $returnMessage = post($inputData,$db);
     }
  }

  if ( 'PUT' === $verb ) {
     //if put is the verb, check the ID. If null, throw an exception looking for a id.
     if ( NULL === $id && $inputData === NULL) {
         throw new InvalidArgumentException('Classroom Attribute ID ' . $id . ' was not found');
     } else {
         //if not, run the put function and set the message to the return.
         $returnMessage = put($id,$inputData,$db);
     }
  }

  if ('DELETE' === $verb) {
     //if the delete verb is selected, check the the id is not null, and if so, throw an exception.
     if ( NULL === $id ) {
         throw new InvalidArgumentException('Classroom Attribute ID ' . $id . ' was not found');
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
    return $db->sql("SELECT Class_Attribute_Relation.classroom_id, Classroom.class_number, Class_Attribute_Relation.attributes_id, Attributes.attributes_name from Classroom, Attributes, Class_Attribute_Relation WHERE Class_Attribute_Relation.classroom_id = Classroom.classroom_id AND Class_Attribute_Relation.attributes_id = Attributes.attributes_id;");
    //return $this->db;
}

function get($id,$db) {
    //Creates statement used to get specific entry from the database based on an id given via endpoint
    return $db->sql("SELECT Class_Attribute_Relation.classroom_id, Classroom.class_number, Class_Attribute_Relation.attributes_id, Attributes.attributes_name from Classroom, Attributes, Class_Attribute_Relation WHERE Class_Attribute_Relation.classroom_id = Classroom.classroom_id AND Class_Attribute_Relation.attributes_id = Attributes.attributes_id AND class_attr_relation_id ='".$id ."'");
}

function post($data,$db)
{
    //Setups up the insert for SQL for post function as well as binding JSON data provided by the data array to the statement

    try{
       $db->sql("INSERT INTO Class_Attribute_Relation (
         attributes_id, classroom_id)
         VALUES(
       '" .$data['attributes_id']. "',
       '" .$data['classroom_id']. "')
      ;");
      return 'Classroom Attribute Added';
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
      $db->sql("Update Class_Attribute_Relation SET attributes_id ='" .$data['attributes_id'] ."'
      , classroom_id = '". $data['classroom_id'] . "'
      WHERE class_attr_relation_id = '" . $id . "'");
        return 'Classroom Attribute Updated';
    } catch (Exception $e){
            throw new Exception('Classroom Attribute could not be updated');
    }
}

function delete($id,$db) {
    //Delete uses a statment written to delete from the db where the id matches the one located in the endpoint.
    $db->sql("DELETE FROM Class_Attribute_Relation WHERE class_attr_relation_id = '".$id."';");

    if(sizeof($db->sql("select * from Class_Attribute_Relation where class_attr_relation_id ='".$id."';")) == 0)
    {
      return "Classroom Attribute Deleted";
    }  else {
      return "Error Classroom Attribute not Deleted";
    }

}

function dataCheck($data) {
    //The dataCheck function uses the JSON data to make sure that all form objects were properly filled out.
    $errors = array();

    if ($data['attributes_id'] === '' ){
        $errors[] = 'No Attributes ID ';
    } else {
      if(preg_match('/^[0-9]*$/', $data['attributes_id'])){
      } else {
        $errors[] = 'Attributes ID in the wrong format';
      }
    }

    if ($data['classroom_id'] === '' ){
        $errors[] = 'No Classroom ID ';
    } else {
      if(preg_match('/^[0-9]*$/', $data['classroom_id'])){
      } else {
        $errors[] = 'Classroom ID in the wrong format';
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
