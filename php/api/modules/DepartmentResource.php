<?php
/**
 * Class that contains the resources for making any changes to the 'Building' table in the database.
 *
 * @author Mike
 */
class DepartmentResource implements IRestModel{
    private $db;
    function __construct($db) {
      $this->setDB($db);
    }

    function setDB($db) {
      $this->db = $db;
    }

    public function getAll() {
        //Very similar statement to get(), except this function requires no parameters and returns all entries in the db.
        return $this->db->sql("SELECT * FROM Departments");
    }

    public function get($id) {
        //Creates statement used to get specific entry from the database based on an id given via endpoint
        return $this->db->sql("SELECT * FROM Departments WHERE departments_id ='".$id ."'");
    }

    public function post($data)
    {
        //Setups up the insert for SQL for post function as well as binding JSON data provided by the data array to the statement
        //return 'yay';
        try{
           $this->db->sql("INSERT INTO Departments (departments_name)VALUES(
           '" .$data['departments_name']. "');");

          return 'Department Added';
        }
        catch(Exception $e){
          return $e;
        }

    }


    public function put($id,$data)
    {
        //Put function uses a statement written to update a pre-existing db entry.
        try {
          $this->db->sql("Update Departments SET departments_name ='" .$data['departments_name'] .
              "' WHERE departments_id = '" . $id . "'");
                    return 'Department Updated';
        } catch (Exception $e){
                throw new Exception('Departments could not be updated');
        }
    }

    public function delete($id) {
        //Delete uses a statment written to delete from the db where the id matches the one located in the endpoint.
        $this->db->sql("DELETE FROM Departments WHERE departments_id = '".$id."';");

        if($this->db->sql("SELECT * from Departments WHERE departments_id ='".$id."';").length == 0)
        {
          return "Attribute Deleted";
        }  else {
          return "Error Attribute not Deleted";
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
