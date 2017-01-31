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
    <h1>Current Campuses</h1>
</div>
<hr />

<div class="campus-container">
    <section>
        <span class="close-edit fa fa-times" onClick="closeEdit()"></span>
        <div class="campus-info-container">
            <div class="campus-image access-road"></div>
            <div class="campus-address">
                <div class="campus-card-header">Access Road Campus</div>
                100 Access Road<br />
                Warwick, RI 02886
            </div>
        </div>
        <button class="btn btn-success edit-campus-btn" onclick="editCampus(this)">Edit</button>
        <div id="access-buildings" class="campus-buildings">
        </div>
    </section>

    <section>
        <span class="close-edit fa fa-times" onClick="closeEdit()"></span>
        <div class="campus-info-container">
            <div class="campus-image east-green"></div>
            <div class="campus-address">
                <div class="campus-card-header">East Greenwich Campus</div>
                One New England Tech Blvd<br />
                East Greenwich, RI 02818-1205
            </div>
        </div>
        <button class="btn btn-success edit-campus-btn" onclick="editCampus(this)">Edit</button>
        <div id="eg-buildings" class="campus-buildings">
        </div>
    </section>

    <section>
        <span class="close-edit fa fa-times" onClick="closeEdit()"></span>
        <div class="campus-info-container">
            <div class="campus-image post-road"></div>
            <div class="campus-address">
                <div class="campus-card-header">Post Road Campus</div>
                2480 Post Road<br />
                Warwick, RI 02886
            </div>
        </div>
        <button class="btn btn-success edit-campus-btn" onclick="editCampus(this)">Edit</button>
        <div id="post-rd-buildings" class="campus-buildings">
        </div>
    </section>
</div>

<script type="text/javascript">
    $(function() {
        console.log("Did It");
        var access = "";
        var eastGreen = "";
        var postRd = "";

        for(var i = 0; i < campuses.length; i++){

            if(campuses[i].campusName == "Access Road"){

                for(var x = 0; x < campuses[i].buildings.length; x++){
                    access += "<div class='buildings-row'>";
                    access += campuses[i].buildings[x].name;
                    access += "<button class='btn btn-success pull-right' onclick='loadSubPage(\"add_edit_building\")'>";
                    access += '<span class="fa fa-plus-circle"></span>';
                    access += 'Add building';
                    access += '</button>';
                    access += '</div>';
                }

            }
            else if(campuses[i].campusName == "East Greenwich"){

                for(var x = 0; x < campuses[i].buildings.length; x++){
                    eastGreen += "<div class='buildings-row'>";
                    eastGreen += campuses[i].buildings[x].name;
                    eastGreen += "<button class='btn btn-success pull-right' onclick='loadPage(\"add_edit_building\")'>";
                    eastGreen += '<span class="fa fa-plus-circle"></span>';
                    eastGreen += 'Add building';
                    eastGreen += '</button>';
                    eastGreen += '</div>';
                }

            }
            else if(campuses[i].campusName == "Post Road"){

                for(var x = 0; x < campuses[i].buildings.length; x++){
                    postRd += "<div class='buildings-row'>";
                    postRd += campuses[i].buildings[x].name;
                    postRd += "<button class='btn btn-success pull-right' onclick='loadPage(\"add_edit_building\")'>";
                    postRd += '<span class="fa fa-plus-circle"></span>';
                    postRd += 'Add building';
                    postRd += '</button>';
                    postRd += '</div>';
                }
            }

        }

        // for(var i = 0; i < campuses.length; i++) {
        //   console.log(campuses[i].buildings.length);
        //   html += '<div class="accordian-container collapsed">';
        //   html += '<div class="accordian-header" onclick="toggleAccordian(this)">';
        //   html += '<span class="fa fa-plus"></span>';
        //   html += campuses[i].campusName;
        //   html += '</div>';
        //   html += '<div class="accordian-body">';
        //
        //     for(var x = 0; x < campuses[i].buildings.length; x++) {
        //       html += campuses[i].buildings[x].name;
        //     }
        //
        //     html += '<span class="fa fa-trash pull-right" onClick="deleteAlert()"></span>';
        //     html += '<span class="fa fa-pencil-square-o pull-right" onClick="loadPage(\'add_edit_building\')"></span>';
        //     html += '</div>';
        //     html += '</div>';
        // }

        $("#access-buildings").html(access);
        $("#eg-buildings").html(eastGreen);
        $("#post-rd-buildings").html(postRd);

        access = "";
        eastGreen = "";
        postRd = "";
    })
</script>