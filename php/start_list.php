<?php
//if program id is passed set it to a php variable
if(isset($_GET['pid'])){
    $program_id = $_GET['pid'];
}
if(isset($_GET['did'])){
    $degree_id = $_GET['did'];
}

include('./autoload.php');

 $db = new DAO();

if (isset($program_id)){
    $starts = $db->sql("SELECT * FROM Curriculum where curriculum_id = '" .$program_id ."' AND degree_type_id = '" .$degree_id ."'");
    foreach($starts as $s){
        echo '<option value="'. $s['curriculum_id'] .'">' . $s['start_term'] . '</option>';
    } 
}
 ?>