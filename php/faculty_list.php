<?php
//if search criteria is passed set it to a php variable
if (isset($_GET['sc'])) {
    $searchCriteria = $_GET['sc'];
}
include('./autoload.php');

// var_dump($searchCriteria);
// echo 'hello';

$db = new DAO();
$searchResults = array();
$empty;
$faculty = array();

// $faculty = $db->sql("SELECT * FROM Faculty");
// var_dump($faculty);

//if there is a search criteria pull faculty information
 if (isset($searchCriteria)){
    $searchResults = $db->sql("SELECT * FROM Faculty WHERE first_name LIKE '%" . $searchCriteria ."%' ORDER BY last_name");

    if(count($searchCriteria) > 0){
        echo '<ul>';
            foreach($searchResults as $sr){
                echo '<li data-fid="' .$sr[faculty_id]. '">'. $sr[first_name] . ' ' . $sr[last_name] . '<span class="pull-right"x>Edit | Delete</span></li>';
            }
        echo '</ul>';
    }
    else {
        echo 'No result returned';
    }

    
 }

 
?>