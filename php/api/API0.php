<?php
/**
 * Class that manages the transfer of data between the front end and the data layer
 *
 * @author Mike
 */
 header('Content-type: application/json');
 include('./autoload.php');

$data = array();
$dbc = new DAO();

$success = true;
$response_array['status'] = 'success';
$db_success = '';
$err_msg = '';

//switch($_POST['company']){
  //  case 'building':
  //  buildingResourceRun
//}
$data['campus_id'] = $_POST['campusName'];
$data['building_abbreviation'] = 'TS';
$data['building_name'] = $_POST['building_name'];
$data['address'] = $_POST['addressLine1'];
$data['city'] = $_POST['city'];
$data['state'] = $_POST['state'];
$data['zip'] = $_POST['zip'];

$message = buildingResourceRun('building', 'post', NULL, $data);

echo json_encode($message);
/*
* API Resources Function for Buildings
* REST SERVER CALLS FOR BUILDING RESOURCES
*/

function buildingResourceRun($resource,$verb, $id = NULL ,$inputData = NULL ){
  $returnMessage;
  $buildingResource = new BuildingResource($dbc);
  if ( 'GET' === $verb ) {
      if ( NULL === $id ) {
          $this->setData($buildingResource->getAll());
      } else {
          $this->setData($buildingResource->get($id));
      }
  }

  if ( 'POST' === $verb ) {
      if ($inputData === NULL) {
          throw new Exception('Building could not be added');
      } else {
          $returnMessage = $buildingResource->post($inputData);
      }
  }

  if ( 'PUT' === $verb ) {
      //if put is the verb, check the ID. If null, throw an exception looking for a id.
      if ( NULL === $id && $inputData === NULL) {
          throw new InvalidArgumentException('Building ID ' . $id . ' was not found');
      } else {
          //if not, run the put function and set the message to the return.
          $this->setData($buildingResource->put($id,$inputData));
      }
  }

  if ('DELETE' === $verb) {
      //if the delete verb is selected, check the the id is not null, and if so, throw an exception.
      if ( NULL === $id ) {
          throw new InvalidArgumentException('Building ID ' . $id . ' was not found');
      } else {
          // if its all clear, set the message to the delete function return.
          $this->setData($buildingResource->delete($id));
      }
  }
  // IMPORTANT!!! Return coming up.
  return $this->convertToJSON($this->getData());
}

/*
* API Resource for Campus
* REST SERVER CALLS NEEDS TO BE FIXED
*/
function campusResource($resource, $verb, $id = NULL ,$inputData = NULL ){
  if ( 'campus' === $resource ) {

      $campusResource = new CampusResource($this->getDB());
      if ( 'GET' === $verb ) {
          if ( NULL === $id ) {
              $this->setData($campusResource->getAll());
          } else {
              $this->setData($campusResource->get($id));
          }
      }

      if ( 'POST' === $verb ) {

          if ($inputData === NULL) {

              throw new Exception('Building could not be added');
          } else {
              $this->setData($campusResource->post($inputData));
          }
      }

      if ( 'PUT' === $verb ) {
          //if put is the verb, check the ID. If null, throw an exception looking for a id.
          if ( NULL === $id && $inputData === NULL) {
              throw new InvalidArgumentException('Building ID ' . $id . ' was not found');
          } else {
              //if not, run the put function and set the message to the return.
              $this->setData($campusResource->put($id,$inputData));
          }
      }

      if ('DELETE' === $verb) {
          //if the delete verb is selected, check the the id is not null, and if so, throw an exception.
          if ( NULL === $id ) {
              throw new InvalidArgumentException('Building ID ' . $id . ' was not found');
          } else {
              // if its all clear, set the message to the delete function return.
              $this->setData($campusResource->delete($id));
          }
      }
  }

  // IMPORTANT!!! Return coming up.
  return $this->convertToJSON($this->getData());

  }
