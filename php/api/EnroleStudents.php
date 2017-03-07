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
    $count = array();
    $id_key = array();
    $holder = array();
    $enrol_total = array();
    //$count['test'] = 1;

    /*$enrollment = $db->sql("SELECT course_id FROM Enrollment");

    foreach ($enrollment as $header => $value) {
      $i = 0;
      foreach ($enrollment as $value => $thing) {
        $cid = $thing['course_id'] ;
        $holder[$i] = $cid;
        $i++;
        }
    }
    $ie = 0;
    foreach($holder as $cur_val){

      if(array_key_exists($cur_val, $count) === true){
        $count[$cur_val] = $count[$cur_val] + 1;
      }
      else {
        $count[$cur_val] = 1;
        $id_key[$ie] = $cur_val;
      }
      $ie++;
    }

    $if = 0;
    foreach($count as $total){

    }

    //array_multisort($count, SORT_DESC);

    var_dump($count);
    echo "\n\n -------------------------------------------------------------------------";
    var_dump($id_key);
    */
  }
?>
