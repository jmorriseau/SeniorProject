<?php
/**
 * Class that contains the resources for making any changes to the 'Building' table in the database.
 *
 * @author Mike
 */
class BuildingResource implements IRestModel{
    private $db;
    function __construct($db) {
      $this->setDB($db);
    }

    function setDB($db) {
      $this->db = $db;
    }

    public function getAll() {
        //Very similar statement to get(), except this function requires no parameters and returns all entries in the db.
        return $this->db->sql("SELECT * FROM Building");
        //return $this->db;
    }

    public function get($id) {
        //Creates statement used to get specific entry from the database based on an id given via endpoint
        return $this->db->sql("SELECT * FROM Building where building_id ='".$id ."'");
    }

    public function post($data)
    {
        //Setups up the insert for SQL for post function as well as binding JSON data provided by the data array to the statement
        //return 'yay';
        try{
           $this->db->sql("INSERT INTO Building (
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
          return $e;
        }

    }


    public function put($id,$data)
    {
        //Put function uses a statement written to update a pre-existing db entry.
        try {
          $this->db->sql("UPDATE Building SET
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

    public function delete($id) {
        //Delete uses a statment written to delete from the db where the id matches the one located in the endpoint.
        $this->db->sql("DELETE FROM Building WHERE building_id = '".$id."';");

        if($this->db->sql("select * from Building where building_id ='".$id."';").length == 0)
        {
          return "Building Deleted";
        }  else {
          return "Error Building not Deleted";
        }

    }
}
