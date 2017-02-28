<?php
//if campus id is passed set it to a php variable
if (isset($_GET['cid'])) {
    $campus_id = $_GET['cid'];
}
include('./autoload.php');

$db = new DAO();

if (isset($campus_id)){
    $buildings = $db->sql("SELECT * FROM Building WHERE campus_id = '" .$campus_id ."'");
    foreach($buildings as $b){
        echo '<option value="'. $b['building_id'] .'">' . $b['building_name'] . '</option>';
    } 
}

?>