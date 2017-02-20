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
$faculty = array();

// $faculty = $db->sql("SELECT * FROM Faculty");
// var_dump($faculty);

//if there is a search criteria pull faculty information
 if (isset($searchCriteria)){
    $searchResults = $db->sql("SELECT * FROM Faculty where first_name LIKE '%" .$searchCriteria ."%'");
    //var_dump($searchResults);

    echo '<ul>';
    foreach($searchResults as $sr){
        echo "<li>". $sr[first_name] . " " . $sr[last_name] . "<span class='pull-right'><span class='mock-link' onclick='loadPage(\"add_edit_faculty\")'>Edit</span> | <a href='#'>Delete</a></span></li>";
    }
    echo '</ul>';
 }
 else {
     $searchResults = "No results to display";
     echo $searchResults;
 }
 
 
?>