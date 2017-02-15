<?php
//include('./autoload.php');
//$util = new Util();
//$dbc = new DB_Connect($util->getDBConfig());
//$connection = $dbc->getDBConnection();
//("Select * FROM [dbo].[Campus]");

//$campus_sql_result = $db->sql("SELECT * FROM Building where building_id ='". 6 ."'");
//echo "<ul>";
//while ($campus_sql_result = $db->fetch(PDO::FETCH_ASSOC)){
//var_dump($campus_sql_result);
//var_dump($campus_sql_result);
//var_dump(json_encode($campus_sql_result));
//}
//echo "</ul>";

//$building = $db->sql("SELECT * FROM Building WHERE building_id = 4");
//var_dump($campus_sql_result);
//var_dump($building);
//die();

include('./autoload.php');

/*$dbc = new DAO();
$enrollments = array();
$classTally = array();
$found = FALSE;

$enrollments = $dbc->sql("SELECT course_id from Enrollment;");

foreach ($enrollments as $id => $value) {
  foreach ($classTally as $course => $enr) {
    if($course === $value){
      $enr = $enr + 1;
      $found = TRUE;
    } elseif($found === FALSE){
      $classTally;
    }
  }
}

var_dump($classTally);*/

?>
This is the faculty page.

<h1>Faculty</h1>
<hr/>
<div class="alpha-search">
  A | B | C | D | E | F | G | H | I | J | K | L | M | N | O | P | Q | R | S | T | U | V | W | X | Y | Z &nbsp;&nbsp;&nbsp;
  <span class="fa fa-search"></span>

</div>

<div class="result-faculty">

  <ul>
    <li>George Saban <span class="pull-right"><span class="mock-link" onclick="loadPage('add_edit_faculty')">Edit</span> | <a href="#">Delete</a></span></li>
    <li>Joe Collins <span class="pull-right"><a href="#">Edit</a> | <a href="#">Delete</a></span></li>
    <li>Chris Kemp <span class="pull-right"><a href="#">Edit</a> | <a href="#">Delete</a></span></li>
    <li>Mickey Mouse <span class="pull-right"><a href="#">Edit</a> | <a href="#">Delete</a></span></li>
  </ul>
</div>
