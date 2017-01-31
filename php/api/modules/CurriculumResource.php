<?php
/**
 * Class that contains the resources for making any changes to the 'Curriculum' table in the database.
 *
 * @author Joshua
 */
class CurriculumResource implements IRestModel{

    private $db;
    function __construct($db) {
      $this->setDB($db);
    }

    function setDB($db) {
      $this->db = $db;
    }

    public function getAll() {
        //Very similar statement to get(), except this function requires no parameters and returns all entries in the db.
        return $this->db->sql("SELECT * FROM Curriculum");
        //return $this->db;
    }

    public function get($id) {
        //Creates statement used to get specific entry from the database based on an id given via endpoint
        return $this->db->sql("SELECT * FROM Curriculum where curriculum_id ='".$id ."'");
    }

    public function post($data)
    {
        //Setups up the insert for SQL for post function as well as binding JSON data provided by the data array to the statement
        //return 'yay';
        try{
           $this->db->sql("INSERT INTO Curriculum (
             curriculum_id, department_id, curriculum_name, degree_type_id, start_term,end_term)
             VALUES(
           '" .$data['building_id']. "',
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
          return $e;
        }

    }

    public function put($id,$data)
{
    //Put function uses a statement written to update a pre-existing db entry.
  //  try {
  //    $this->db->sql("Update Building SET
  //    campus_name = '".$data['campus_name']."'
    //  WHERE campus_id = '" .$id. "'");
  //      return 'Campus Updated';
  //  } catch (Exception $e){
          //  throw new Exception('Campus could not be updated');
  //  }
}

public function delete($id) {
    //Delete uses a statment written to delete from the db where the id matches the one located in the endpoint.
    $this->db->sql("DELETE FROM Curriculum WHERE curriculum_id = '".$id."';");

    if($this->db->sql("select * from Curriculum where curriculum_id ='".$id."';").length == 0)
    {
      return "Curriculum Deleted";
    }  else {
      return "Error Curriculum not Deleted";
    }
}


}
