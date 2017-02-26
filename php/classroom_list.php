<?php
//if campus id is passed set it to a php variable
if (isset($_GET['cid'])) {
    $campus_id = $_GET['cid'];
}
include('./autoload.php');

$db = new DAO();

if (isset($campus_id)){
    $buldings = $db->sql("SELECT * FROM Building WHERE campus_id = '" .$campus_id ."'");
    echo json_encode($buldings);
}

?>