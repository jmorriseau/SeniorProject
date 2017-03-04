<?php
/**
 * Class that contains the resources for making any changes to the 'Attribute' table in the database.
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
     $message = attributeResourceRun('GET', $id , NULL, $dbc);
     break;

   case 'POST':
     $data['attribute_type_id'] = $_POST['attributeTypeId'];
     $data['attributes_name'] = $_POST['attributesName'];
     if(dataCheck($data)){
       $message = attributeResourceRun('POST', NULL, $data, $dbc);
     }
     else{ $message = "Data not in correct format";}
     break;

   case 'PUT':
     parse_str(file_get_contents('php://input'), $put);
     $data['attribute_type_id'] = $put['attributeTypeId'];
     $data['attributes_name'] = $put['attributesName'];
     $id = $put['id'];
     if(dataCheck($data)){
       $message = attributeResourceRun('PUT', $id, $data, $dbc);
     }
     else{ $message = "Data not in correct format";}
     break;

   case 'DELETE':
     $id = $_GET['id'];
     $message = attributeResourceRun('DELETE', $id, NULL, $dbc);
     break;
 }

 echo json_encode($message);
 /*
 * API Resources Function for Buildings
 * REST SERVER CALLS FOR BUILDING RESOURCES
 */

 function attributeResourceRun($verb, $id = NULL ,$inputData = NULL, $db){
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
         throw new Exception('Attribute could not be added');
     } else {
         $returnMessage = post($inputData,$db);
     }
 }

 if ( 'PUT' === $verb ) {
     //if put is the verb, check the ID. If null, throw an exception looking for a id.
     if ( NULL === $id && $inputData === NULL) {
         throw new InvalidArgumentException('Attribute ID ' . $id . ' was not found');
     } else {
         //if not, run the put function and set the message to the return.
         $returnMessage = put($id,$inputData,$db);
     }
 }

 if ('DELETE' === $verb) {
     //if the delete verb is selected, check the the id is not null, and if so, throw an exception.
     if ( NULL === $id ) {
         throw new InvalidArgumentException('Attribute ID ' . $id . ' was not found');
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
        return $db->sql("SELECT Attributes.attributes_id, Attributes.attributes_name, Attribute_Types.attribute_type_name FROM Attributes, Attribute_Types WHERE Attributes.attribute_type_id = Attribute_Types.attribute_type_id");
        //return $this->db;
    }

     function get($id,$db) {
        //Creates statement used to get specific entry from the database based on an id given via endpoint
        return $db->sql("SELECT Attributes.attributes_id, Attributes.attributes_name, Attribute_Types.attribute_type_name FROM Attributes, Attribute_Types WHERE Attributes.attribute_type_id = Attribute_Types.attribute_type_id AND attributes_id ='".$id ."'");
    }

     function post($data,$db)
    {
        //Setups up the insert for SQL for post function as well as binding JSON data provided by the data array to the statement
        //return 'yay';
        try{
          $db->sql("INSERT INTO Attributes (
             attribute_type_id, attributes_name)
             VALUES(
           '" .$data['attribute_type_id']. "',
           '" .$data['attributes_name']. "')
          ;");

          return 'Attribute Added';
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
          $db->sql("Update Attributes SET attribute_type_id ='" .$data['attribute_type_id'] ."'
          , attributes_name = '". $data['attributes_name'] . "'
          WHERE attributes_id = '" . $id . "'");
            return 'Attribute Updated';
        } catch (Exception $e){
                throw new Exception('Attribute could not be updated');
        }
    }

     function delete($id,$db) {
        //Delete uses a statment written to delete from the db where the id matches the one located in the endpoint.
        $db->sql("DELETE FROM Attributes WHERE attributes_id = '".$id."';");

        if($db->sql("select * from Attributes where attributes_id ='".$id."';").length == 0)
        {
          return "Attribute Deleted";
        }  else {
          return "Error Attribute not Deleted";
        }

    }

    function dataCheck($data) {
        //The dataCheck function uses the JSON data to make sure that all form objects were properly filled out.
        $errors = array();

        if ($data['attribute_type_id'] === '' ){
            $errors[] = 'No Attribute Type ID ';
        } else {
          if (!preg_match('/^[0-9]*$/', $data['attribute_type_id'])){
          } else {
            $errors[] = 'Attribute Type ID in the wrong format';
          }
        }
        if ($data['attributes_name'] === '' ){
            $errors[] = 'No Attribute Name ';
        } else {
          if (!preg_match('/^[a-zA-Z 0-9]*$/', $data['attributes_name'])){
          } else {
            $errors[] = 'Attributes Name in the wrong format';
          }
        }
        if (count($errors) > 0)
        {
            throw new Exception('Form not fully filled');
            return false;
        }
        else{
            return true;
        }
    }
