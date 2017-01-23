<?php
include('./autoload.php');
$util = new Util();
//$dbc = new DB_Connect($util->getDBConfig());
//$connection = $dbc->getDBConnection();
//("Select * FROM [dbo].[Campus]");

$campus_sql_result = $db->sql("SELECT * FROM Building where building_id ='". 6 ."'");
//echo "<ul>";
//while ($campus_sql_result = $db->fetch(PDO::FETCH_ASSOC)){
//var_dump($campus_sql_result);
//var_dump($campus_sql_result);
var_dump(json_encode($campus_sql_result));
//}
//echo "</ul>";


//$building = $db->sql("SELECT * FROM Building WHERE building_id = 4");
//var_dump($campus_sql_result);
//var_dump($building);
die();
?>
This is the faculty page.
<!--?php
$serverName = "sql.neit.edu,4500";
$database = "SE414_GroupProject";
$uid = 'SE414_GroupProject';
$pwd = '1234567890';
try {
$conn = new PDO(
"sqlsrv:server=$serverName;Database=$database",
$uid,
$pwd,
array(
//PDO::ATTR_PERSISTENT => true,
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
)
);
}
catch(PDOException $e) {
die("Error connecting to SQL Server: " . $e->getMessage());
}
$query = 'select * from Building';
$stmt = $conn->query( $query );
$row = array();
//echo "<ul>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo json_encode($row);
    }
    //echo "</ul>";
// Free statement and connection resources.
$stmt = null;
$conn = null;
?-->


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
