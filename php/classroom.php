<?php
include('./autoload.php');

 $db = new DAO();
 $campus = array();
 $building = array();
 $floor = array();


 ?>

<div class="header">
  <h1>Current Classrooms</h1>
</div>
<hr />

<div class="classroom-container content-container">

  <div class="classroom-selector select-campus">
    <label>Select a campus:</label>
    <select class="campuses-drop-down" onchange="updateSlidingSelect('.select-campus','.select-building');getCampusBuildings()">
      <option value="">--Choose One--</option>
      <?php
        $campus = $db->sql("SELECT * FROM Campus");

        if(count($campus) > 0){
          foreach($campus as $c){
            echo '<option value="'.$c['campus_id'].'">' . $c['campus_name'] . '</option>';
          }
        }
      ?>
    </select>
  </div>

  <div class="classroom-selector select-building">
    <label>Select a building:</label>
    <select class="buildings-drop-down" onchange="updateSlidingSelect('.select-building','.select-floor')">
      <option value="">--Choose One--</option>


    </select>
  </div>

  <div class="classroom-selector select-floor">
    <label>Select a floor:</label>
    <select onchange="updateSlidingSelect('.select-floor','.result-classrooms')">
      <option value="">--Choose One--</option>
      <option value="floor_one">Frist Floor</option>
      <option value="floor_two">Second Floor</option>
      <option value="floor_three">Third Floor</option>
    </select>
  </div>

  <div class="result-classrooms">
    Available Classrooms
    <ul>
      <li>N208 <span class="pull-right"><span class="mock-link" onclick="loadPage('add_edit_classroom')">Edit</span> | <a href="#">Delete</a></span></li>
      <li>N209 <span class="pull-right"><a href="#">Edit</a> | <a href="#">Delete</a></span></li>
      <li>N210 <span class="pull-right"><a href="#">Edit</a> | <a href="#">Delete</a></span></li>
      <li>N215 <span class="pull-right"><a href="#">Edit</a> | <a href="#">Delete</a></span></li>
    </ul>
  </div>

</div>
