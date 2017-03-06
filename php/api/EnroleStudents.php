<?php
  header('Content-type: application/json');
  include('../autoload.php');

  $dbc = new DAO();

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $file = $_POST['file']; #Takes file name from front end

    $csv = array_map('str_getcsv', file('../text_files/' . $file)); #Break CSV into Array

    array_walk($csv, function(&$a) use ($csv) {
      $a = array_combine($csv[0], $a);
    }); # makes the raw CSV file that include headers into associative array

    array_shift($csv); # remove column header


    foreach ($csv as $header => $value) {
      $dbc->sql("INSERT INTO Enrollment (
        course_id, student_id)
        VALUES(
      '" .$value['course_id']. "',
      '" .$value['student_id']. "' )
     ;"); #Inserts enrollment into database
    }

  }

  function createClasses($dbc){
      $enrollment = $dbc->sql("SELECT * FROM Enrollment");
  }
?>
