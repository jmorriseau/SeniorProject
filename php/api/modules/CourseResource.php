<?php
/**
 * Class that contains the resources for making any changes to the 'Building' table in the database.
 *
 * @author Mike
 */
class CourseResource implements IRestModel{
    private $db;
    function __construct($db) {
      $this->setDB($db);
    }

    function setDB($db) {
      $this->db = $db;
    }

    public function getAll() {
        //Very similar statement to get(), except this function requires no parameters and returns all entries in the db.
        return $this->db->sql("SELECT * FROM Courses");
        //return $this->db;
    }

    public function get($id) {
        //Creates statement used to get specific entry from the database based on an id given via endpoint
        return $this->db->sql("SELECT * FROM Courses where course_id ='".$id ."'");
    }

    public function post($data)
    {
        //Setups up the insert for SQL for post function as well as binding JSON data provided by the data array to the statement
        //return 'yay';
        try{
           $this->db->sql("INSERT INTO Courses (
             course_name, course_number, credit_hours, semester_number)
             VALUES(
           '" .$data['course_name']. "',
           '" .$data['course_number']. "',
           '" .$data['credit_hours']. "',
           '" .$data['semester_number']. "')
          ;");

          return 'Course Added';
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
          $this->db->sql("UPDATE Courses SET
            course_name = '" .$data['course_name'] ."'
          , course_number = '". $data['course_number'] . "'
          , credit_hours = '" . $data['credit_hours'] . "'
          , semester_number = '" . $data['semester_number'] . "'
          WHERE course_id = '" .$id. "'");
          return 'Course Updated';
        } catch (Exception $e){
                throw new Exception('Course could not be updated');
        }
    }

    public function delete($id) {
        //Delete uses a statment written to delete from the db where the id matches the one located in the endpoint.
        $this->db->sql("DELETE FROM Courses WHERE course_id = '".$id."';");

        if($this->db->sql("SELECT * from Courses where course_id ='".$id."';").length == 0)
        {
          return "Course Deleted";
        }  else {
          return "Error Course not Deleted";
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
