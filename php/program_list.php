<?php
//if degree id is passed set it to a php variable
if(isset($_GET['did'])){
    $degree_id = $_GET['did'];
}

include('./autoload.php');

 $db = new DAO();

if (isset($degree_id)){
    $programs = $db->sql("SELECT * FROM Curriculum where degree_type_id = '" .$degree_id ."'");
    foreach($programs as $p){
        echo '<option value="'. $p['curriculum_id'] .'">' . $p['curriculum_name'] . '</option>';
    } 
}
 ?>