<?php
//if search criteria is passed set it to a php variable
if (isset($_GET['sc'])) {
    $searchCriteria = $_GET['sc'];
}
include('./autoload.php');

$db = new DAO();
$searchResults = array();
$empty;
$faculty = array();

//if there is a search criteria pull faculty information
 if (isset($searchCriteria)){
    $searchResults = $db->sql("SELECT * FROM Faculty WHERE last_name LIKE '" . $searchCriteria ."%' ORDER BY last_name");

    if(count($searchResults) > 0){       
        echo '<ul>';
            foreach($searchResults as $sr){
                echo '<li class="edit-faculty" data-fid="' .$sr[faculty_id]. '">'. $sr[first_name] . ' ' . $sr[last_name] . '<span class="pull-right">Edit</span></li>';
            }
        echo '</ul>';
    }
    else if(count($searchResults) < 1) {
        echo 'No results returned.';
    }   
 }

 
?>