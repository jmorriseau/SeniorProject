<?php
/**
 * Class that contains the resources for making any changes to the database
 *
 * @author Mike
 */
//TODO: Add more error checking capabilites to the dataCheck function
//ex. Proper syntax, etc.
class BuildingResource implements IRestModel{

    private $db;
    function __construct($db) {
        //sets connection to the database
        //$util = new Util();
        //$dbo = new DB_Connect($util->getDBConfig());
        $this->setDB($db);
    }
    function setDB($db) {
        $this->db = $db;
    }


    public function getAll() {
        //Very similar statement to get(), except this function requires no parameters and returns all entries in the db.
        return $this->db->sql("SELECT * FROM Building");
    }


    public function get($id) {
        //Creates statement used to get specific entry from the database based on an id given via endpoint

        return $this->db->sql("SELECT * FROM Building where building_id ='".$id ."'");

    }

    function post($data)
    {
        //Setups up the insert for SQL for post function as well as binding JSON data provided by the data array to the statement

        try{
          $this->db->sql("INSERT INTO Building SET campus_id = '".$data['campus_id'].
          "', building_name = '".$data['building_name'].
              "', building_abbreviation = '".$data['building_abbreviation']."';");
          return 'Building Added';

        }
        catch(Exception $e){
          throw new Exception('Building could not be added');
        }

    }


    public function put($id,$data)
    {
        //Put function uses a statement written to update a pre-existing db entry.
        try {
          $this->db->sql("Update Building SET campus_id ='" .$data['campus_id'] .
              "', building_abreviation = '" . $data['building_abbreviation'] .
              "', building_name = '" . $data['building_name'] .
              "', address = '" . $data['address'] .
              "', city = '" . $data['city'] .
              "', state = '" . $data['state'] .
              "', zip = '" . $data['zip'] .
              "', WHERE building_id = '" . $data['building_id'] . "'");
            return 'Building Updated';
        } catch (Exception $e){
                throw new Exception('Building could not be updated');
        }
    }

    public function delete($id) {
        //Delete uses a statment written to delete from the db where the id matches the one located in the endpoint.
        $this->db->sql("DELETE FROM Building WHERE building_id = '".$id."';");

        if($this->db->sql("select * from Building where building_id ='".$id."';").length == 0)
        {
          return "Building Deleted";
        }  else {

            throw new InvalidArgumentException('Building ID ' . $id . ' was not found');
        }

    }

    public function dataCheck($data) {
        //The dataCheck function uses the JSON data to make sure that all form objects were properly filled out.
        $errors = array();

        if ($data['campus_id'] === '' ){
            $errors[] = 'No Campus ID ';
        }
        if ($data['building_abbreviation'] === '' ){
            $errors[] = 'No Abbreviation ';
        }
        if ($data['building_name'] === '' ){
            $errors[] = 'No Building Name ';
        } if ($data['address'] === '' ){
            $errors[] = 'No Address ';
        }
        if ($data['city'] === '' ){
            $errors[] = 'No City ';
        }
        if ($data['state'] === '' ){
            $errors[] = 'No State ';
        }


        if (count($errors) > 0)
        {
            throw new Exception('Form not fully filled');
        }
        else{
            return true;
        }

    }



}
