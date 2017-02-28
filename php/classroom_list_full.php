<?php
//if campus id is passed set it to a php variable
if (isset($_GET['cid'])) {
    $campus_id = $_GET['cid'];
}
//if building id is passed set it to a php variable
if(isset($_GET['bid'])){
    $building_id = $_GET['bid'];
}
//if floor is is passed set it to a php variable
if(isset($_GET['fid'])){
    $floor_id = $_GET['fid'];
}

include('./autoload.php');

$db = new DAO();

if ( (isset($campus_id)) && (isset($building_id)) && (isset($floor_id)) ){
    $classroomList = $db->sql("SELECT * FROM Classroom WHERE building_id = '" . $building_id ."' AND class_number LIKE '" . $building_id ."%' ORDER BY class_number");

    if(count($classroomList) > 0){
        echo '<ul>';
            foreach($classroomList as $c){
                echo '<li class="edit-classroom" data-bid="' .$building_id. '" data-cid="' .$c[classroom_id]. '">Room ' .$c[class_number]. '<span class="pull-right">Edit</span></li>';
            }
        echo '</ul>';
    }
    else {
        echo 'No classrooms meet this criteria';
    }
}


?>