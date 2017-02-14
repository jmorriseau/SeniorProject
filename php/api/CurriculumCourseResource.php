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
    $message = curriculumCourseResourceRun('GET', $id , NULL, $dbc);
    break;

  case 'POST':
    $data['department_id'] = $_POST['departmentID'];
    $data['curriculum_name'] = $_POST['curriculumName'];
    $data['degree_type_id'] = $_POST['degreeTypeId'];
    $data['start_term'] = $_POST['startTerm'];
    $data['end_term'] = $_POST['endTerm'];
    $message = curriculumCourseResourceRun('POST', NULL, $data, $dbc);
    break;

  case 'PUT':
    $data['department_id'] = $_POST['departmentID'];
    $data['curriculum_name'] = $_POST['curriculumName'];
    $data['degree_type_id'] = $_POST['degreeTypeId'];
    $data['start_term'] = $_POST['startTerm'];
    $data['end_term'] = $_POST['endTerm'];
    $id = $_POST['id'];
    $message = curriculumCourseResourceRun('PUT', $id, $data, $dbc);
    break;

  case 'DELETE':
    $id = $_GET['id'];
    $message = curriculumCourseResourceRun('DELETE', $id, NULL, $dbc);
    break;
}

echo json_encode($message);
/*
* API Resources Function for Buildings
* REST SERVER CALLS FOR BUILDING RESOURCES
*/

function curriculumCourseResourceRun($verb, $id = NULL ,$inputData = NULL, $db){
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
    return $db->sql("SELECT Curriculum_Course_Relation.curriculum_id, Curriculum.curriculum_name, Curriculum_Course_Relation.course_id, Courses.course_name from Courses, Curriculum, Curriculum_Course_Relation WHERE Curriculum_Course_Relation.course_id = Courses.course_id AND Curriculum_Course_Relation.curriculum_id = Curriculum.curriculum_id");
    //return $this->db;
}

function get($id,$db) {
    //Creates statement used to get specific entry from the database based on an id given via endpoint
    return $db->sql("SELECT Curriculum_Course_Relation.curriculum_id, Curriculum.curriculum_name, Curriculum_Course_Relation.course_id, Courses.course_name from Courses, Curriculum, Curriculum_Course_Relation WHERE Curriculum_Course_Relation.course_id = Courses.course_id AND Curriculum_Course_Relation.curriculum_id = Curriculum.curriculum_id AND curriculum_course_relation_id ='".$id ."'");
}

function post($data,$db)
{
    //Setups up the insert for SQL for post function as well as binding JSON data provided by the data array to the statement
    //return 'yay';
    try{
       $db->sql("INSERT INTO Curriculum_Course_Relation (
         curriculum_id, course_id)
         VALUES(
       '" .$data['curriculum_id']. "',
       '" .$data['course_id']. "')
      ;");

      return 'Curriculum Course Added';
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
    $db->sql("UPDATE Curriculum_Course_Relation SET
      curriculum_id = '" .$data['curriculum_id'] ."'
    , course_id = '". $data['course_id'] . "'
    WHERE curriculum_course_relation_id = '" .$id. "'");
    return 'Curriculum Course Updated';
  } catch (Exception $e){
          throw new Exception('Curriculum Course could not be updated');
  }
}

function delete($id,$db) {
  //Delete uses a statment written to delete from the db where the id matches the one located in the endpoint.
  $db->sql("DELETE FROM Curriculum_Course_Relation WHERE curriculum_course_relation_id = '".$id."';");

  if($db->sql("SELECT * from Curriculum_Course_Relation where curriculum_course_relation_id ='".$id."';").length == 0)
  {
    return "Curriculum Course Deleted";
  }  else {
    return "Error Curriculum Course not Deleted";
  }
}
