
<?php
  include('./autoload.php');
  $util = new Util();
  $dbc =  new DAO();
  $api = new API($dbc);
    $data = $api->buildingResourceRun('building', 'GET');
    var_dump($data);
    echo '<br />';
    echo '<br />';
    echo '<br />';
    $data2 = $api->campusResource('campus', 'GET');
    var_dump($data2);
    //$data = $api->resourceRun('building', 'GET', '1');
    //$data2 = $api->resourceRun('campus', 'GET');
    //var_dump($data2);

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
<hr />

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
  $(function() {
    console.log("Did It");
    var html= "";
    for(var i = 0; i < campuses.length; i++) {
      console.log(campuses[i].buildings.length);
      html += '<div class="accordian-container collapsed">';
      html += '<div class="accordian-header" onclick="toggleAccordian(this)">';
      html += '<span class="fa fa-plus"></span>';
      html += campuses[i].campusName;
      html += '</div>';
      html += '<div class="accordian-body">';

      for(var x = 0; x < campuses[i].buildings.length; x++) {
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
