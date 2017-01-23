<?php
/**
 * Class that contains the resources for making any changes to the database
 *
 * @author Mike
 */
require_once './autoload.php';
//TODO: Add more error checking capabilites to the dataCheck function
//ex. Proper syntax, etc.
class CampusResource implements IRestModel{


    private $db;
    function __construct($db) {
        //sets connection to the database
        $this->setDB($db);
    }
     function setDb($db) {
        $this->db = $db;
    }


    public function getAll() {
        //Very similar statement to get(), except this function requires no parameters and returns all entries in the db.
        return  $this->db->sql("SELECT * FROM Campus");

    }

    public function get($id) {
        //Creates statement used to get specific entry from the database based on an id given via endpoint
        return $this->db->sql("SELECT * FROM Campus where campus_id = '".$id ."'");

    }


    function post($data)
    {
        //Setups up the insert for SQL for post function as well as binding JSON data provided by the data array to the statement

        try{
            $this->db->sql("INSERT INTO Campus SET campus_id = '".$data['campus_id'].
                "', campus_name = '".$data['campus_name']."';");
            return 'Campus Added';

        }
        catch(Exception $e){
            throw new Exception('Campus could not be added');
        }

    }
    public function put($id,$data)
    {
        //Put function uses a statement written to update a pre-existing db entry.
        try {
            $this->db->sql("Update Campus SET campus_id ='" .$data['campus_id'] .
                "', WHERE campus_id = '" . $data['campus_id'] . "'");
            return 'Campus Updated';
        } catch (Exception $e){
            throw new Exception('Campus could not be updated');
        }
    }


    public function delete($id) {
        //Delete uses a statement written to delete from the db where the id matches the one located in the endpoint.
        $this->db->sql("DELETE FROM Campus WHERE campus_id = '".$id."';");

        if($this->db->sql("select * from Campus where campus_id ='".$id."';").length == 0) {
            return 'Campus Deleted';
        } else {
            throw new InvalidArgumentException('Campus ID ' . $id . ' was not found');
        }
    }

    public function dataCheck($data) {
        //The dataCheck function uses the JSON data to make sure that all form objects were properly filled out.
        $errors = array();

        if ($data['campus_name'] === '' ){
            $errors[] = 'No Campus Name ';
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
