<?php
/**
 * Class that contains the resources for making any changes to the 'Building' table in the database.
 *
 * @author Mike
 */
class ClassroomResource implements IRestModel{
    private $db;
    function __construct($db) {
      $this->setDB($db);
    }

    function setDB($db) {
      $this->db = $db;
    }

    public function getAll() {
        //Very similar statement to get(), except this function requires no parameters and returns all entries in the db.
        return $this->db->sql("SELECT * FROM Classroom");
        //return $this->db;
    }

    public function get($id) {
        //Creates statement used to get specific entry from the database based on an id given via endpoint
        return $this->db->sql("SELECT * FROM Classroom where classroom_id ='".$id ."'");
    }

    public function post($data)
    {
        //Setups up the insert for SQL for post function as well as binding JSON data provided by the data array to the statement
        //return 'yay';
        try{
           $this->db->sql("INSERT INTO Classroom (
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


    public function put($id,$data)
    {
        //Put function uses a statement written to update a pre-existing db entry.
        try {
          $this->db->sql("Update Classroom SET building_id ='" .$data['building_id'] ."'
          , room_type_id = '". $data['room_type_id'] . "'
          , class_number = '" . $data['class_number'] . "'
          , capacity = '" . $data['capacity'] . "'
          WHERE classroom_id = '" . $id . "'");
            return 'Classroom Updated';
        } catch (Exception $e){
                throw new Exception('Classroom could not be updated');
        }
    }

    public function delete($id) {
        //Delete uses a statment written to delete from the db where the id matches the one located in the endpoint.
        $this->db->sql("DELETE FROM Classroom WHERE classroom_id = '".$id."';");

        if($this->db->sql("select * from Classroom where classroom_id ='".$id."';").length == 0)
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



}
