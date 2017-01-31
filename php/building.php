<?php
include('./autoload.php');
//$util = new Util();
$dbc = new DAO();
$api = new API($dbc);

//Test Get All Test Satisfactory
$data = $api->buildingResourceRun('building', 'GET');
var_dump($data);
//echo "All Buildings";
echo '<br />';
echo '<br />';
echo '<br />';
/*$data2 = $api->campusResourceRun('campus', 'GET');
var_dump($data2);
//echo "All Campuses";
echo '<br />';
echo '<br />';
echo '<br />';*/
/*$data3 = $api->attributeResourceRun('attribute', 'GET');
var_dump($data3);
//echo "All Attributes";
echo '<br />';
echo '<br />';
echo '<br />';*/
/*$data4 = $api->departmentResourceRun('department','GET');
var_dump($data4);
//echo "All Departments";
echo '<br />';
echo '<br />';*/
/*$data5 = $api->classroomResourceRun('classroom','GET');
var_dump($data5);
echo "All Classrooms";
echo '<br />';
echo '<br />';*/

//Test Data
/*$id = 10;
$data_array = array("campus_id"=> 1 ,"building_abbreviation"=>"TB","building_name"=>"Test Building 3","address"=>"1 Test Street","city"=>"Test City","state"=>"TC","zip"=>"02889");

//Resource Call Examples
//$data = $api->resourceRun('building', 'POST', NULL, $data_array);
$data = $api->resourceRun('building', 'PUT', $id, $data_array);
var_dump($data);
//$data = $api->resourceRun('building', 'DELETE', $id, $data_array);
//$data = $api->resourceRun('building', 'GET', '1');

$data3 = $api->resourceRun('building', 'GET');
var_dump($data3);*/
/*//$id = 16;
// = array("campus_id"=> 1 ,""=>""
,"building_name"=>"","address"=>""
,"city"=>""
,"state"=>""
,"zip"=>"");
//$data = $api->buildingResourceRun('building', 'POST', NULL, $data_array);
//$data = $api->buildingResourceRun('building', 'PUT', $id, $data_array);
$data = $api->buildingResourceRun('building', 'DELETE', $id, $data_array);
var_dump($id). "Deleted";*/

//$id = 6;
//$data_array = array("building_id"=>726,"room_type_id"=>1,"class_number"=>69,"capacity"=>100);
//$data = $api->campusResourceRun('campus', 'PUT', $id, $data_array);
//$data = $api->classroomResourceRun('classroom', 'POST', NULL, $data_array);
//$data = $api->campusResourceRun('classroom', 'POST', NULL, $data_array);
//$data = $api->resourceRun('classroom', 'PUT', $id, $data_array);
//var_dump($data);
//$data = $api->campusResourceRun('campus', 'DELETE', $id, $data_array);
//var_dump($data);

//$id = 6;
///$data_array = array("building_id"=> 6 ,"room_type_id"=>1,"class_number"=>69,"capacity"=>10);
//$data = $api->campusResourceRun('classroom', 'PUT', $id, $data_array);
//$data = $api->classroomResourceRun('classroom', 'POST', NULL, $data_array);
//$data = $api->campusResourceRun('classroom', 'POST', NULL, $data_array);
//$data = $api->resourceRun('classroom', 'PUT', $id, $data_array);
//var_dump($data);
//$data = $api->campusResourceRun('classroom', 'DELETE', $id, $data_array);
//var_dump($data);


/*
Test Data attributeResourceRun Satisfactory
*/
//$id = 20;
//$data_array = array("attribute_type_id"=> 1 ,"attributes_name"=>"Test");

//Resource Call Examples
//$data = $api->attributeResourceRun('attribute', 'POST', NULL, $data_array);
//$data = $api->attributeResourceRun('attribute', 'PUT', $id, $data_array);
//var_dump($data);
//$data = $api->attributeResourceRun('attribute', 'DELETE', $id, $data_array);
//$data = $api->attributeResourceRun('attribute', 'GET', '2');
//var_dump($data);
//$data = $api->attributeResourceRun('attribute', 'GET');
//var_dump($data);





//Resource Call Examples Testing

//$data = $api->buildingResourceRun('building', 'POST', NULL, $data_array);
//$data = $api->buildingResourceRun('building', 'PUT', $id, $data_array);
//var_dump($data);
//$data = $api->buildingResourceRun('building', 'DELETE', $id, $data_array);

/*
 * TESTING FOR GET BY ID CALLS SATISFACTORY
 */
/*echo "Buildings by building_id 1";
$data = $api->buildingResourceRun('building', 'GET', '1');
var_dump($data);

echo '<br />';
$data2 = $api->campusResourceRun('campus', 'GET', '1');
echo "Buildings by campus_id 1";
var_dump($data2);
echo '<br />';
$data3 = $api->attributeResourceRun('attribute', 'GET', '1');
echo "Attribute by attributes_id 1, attributes_name, attribute_type_name1 ";
var_dump($data3);
echo '<br />';
$data4 = $api->departmentResourceRun('department', 'GET', '2');
echo "Department by department_is 2";
var_dump($data4);*/
/*$data5 = $api->classroomResourceRun('classroom', 'GET', '1');
echo "Classroom by classroom_id 2";
var_dump($data5);*/



//$connection = $dbc->getDBConnection();
//$campus_sql_result = $db->sql("Select * FROM [dbo].[Campus]");
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
die();
?>

<div class="header">
    <h1>Current Campuses
        <button class="btn btn-success pull-right" onclick="loadPage('add_edit_building')">
            <span class="fa fa-plus-circle"></span>
            Add building
        </button>
    </h1>
</div>
<hr/>

<div class="campus-container">
    <section>1</section>
    <section>2</section>
    <section>3</section>
</div>

<!-- old static accordian
<div class="accordian-container collapsed">
  <div class="accordian-header" onclick="toggleAccordian(this)">
    <span class="fa fa-plus"></span>
    Access Road Campus
  </div>
  <div class="accordian-body">
    North Building
    <span class="fa fa-trash pull-right" onClick="deleteAlert()"></span>
    <span class="fa fa-pencil-square-o pull-right" onClick="loadPage('add_edit_building')"></span>
  </div>
</div>

<div class="accordian-container collapsed">
  <div class="accordian-header" onclick="toggleAccordian(this)">
    <span class="fa fa-plus"></span>
    East Greenwich Campus
  </div>
  <div class="accordian-body">
    Main Building
    <span class="fa fa-trash pull-right" onClick="deleteAlert()"></span>
    <span class="fa fa-pencil-square-o pull-right" onClick="loadPage('add_edit_building')"></span>
  </div>
</div>

<div class="accordian-container collapsed">
  <div class="accordian-header" onclick="toggleAccordian(this)">
    <span class="fa fa-plus"></span>
    Post Road Campus
  </div>
  <div class="accordian-body">
    Something building.
    <span class="fa fa-trash pull-right" onClick="deleteAlert()"></span>
    <span class="fa fa-pencil-square-o pull-right" onClick="loadPage('add_edit_building')"></span>
  </div>
</div>
-->

<div id="current-campuses"></div>
<script type="text/javascript">
    $(function () {
        console.log("Did It");
        var html = "";
        for (var i = 0; i < campuses.length; i++) {
            console.log(campuses[i].buildings.length);
            html += '<div class="accordian-container collapsed">';
            html += '<div class="accordian-header" onclick="toggleAccordian(this)">';
            html += '<span class="fa fa-plus"></span>';
            html += campuses[i].campusName;
            html += '</div>';
            html += '<div class="accordian-body">';

            for (var x = 0; x < campuses[i].buildings.length; x++) {
                html += campuses[i].buildings[x].name;
            }

            html += '<span class="fa fa-trash pull-right" onClick="deleteAlert()"></span>';
            html += '<span class="fa fa-pencil-square-o pull-right" onClick="loadPage(\'add_edit_building\')"></span>';
            html += '</div>';
            html += '</div>';
        }

        $("#current-campuses").html(html);
        html = "";
    })
</script>
