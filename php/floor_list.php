<?php
//if building id is passed set it to a php variable
if (isset($_GET['bid'])) {
    $building_id = $_GET['bid'];
}
include('./autoload.php');

$db = new DAO();

if (isset($building_id)){
    $floors = $db->sql("SELECT class_number FROM Classroom WHERE building_id = '" .$building_id ."'");
    foreach($floors as $f){
        if(substr($f['class_number'], 0, 1) == 1){
            $countOne++;
        }
        if(substr($f['class_number'], 0, 1) == 2){
            $countTwo++;
        }
        if(substr($f['class_number'], 0, 1) == 3){
            $countThree++;
        }
    }

    if(($countOne == NULL) || ($countTwo == NULL) || ($countThree == NULL)){
        //echo 'No floors';
        echo '<option value="1">First Floor</option>';
        echo '<option value="2">Second Floor</option>';
        echo '<option value="3">Third Floor</option>';
    }
    else {
        if($countOne > 0){
        echo '<option value="1">First Floor</option>';
        }
        if($countTwo > 0){
        echo '<option value="2">Second Floor</option>';
        }
        if($countThree > 0){
        echo '<option value="3">Third Floor</option>';
        }
    }
     
}

?>