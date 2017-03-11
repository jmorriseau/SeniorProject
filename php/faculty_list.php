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
    $facultyList = "";

    if(count($searchResults) > 0){       
        $facultyList .= '<ul>';
            foreach($searchResults as $sr){
                $facultyList .='<li class="edit-faculty" data-fid="' .$sr[faculty_id]. '">'. $sr[first_name] . ' ' . $sr[last_name] . '<span class="pull-right">Edit</span></li>';
            }
        $facultyList .='</ul>';
        echo $facultyList;
    }
    else if(count($searchResults) < 1) {
        echo 'No results returned.';
    }   
 }

 
?>