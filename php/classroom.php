<?php
include('./autoload.php');

 $db = new DAO();

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
    <select class="buildings-drop-down" onchange="updateSlidingSelect('.select-building','.select-floor');getBuildingFloors()">
      <option value="">--Choose One--</option>
    </select>
  </div>

  <div class="classroom-selector select-floor">
    <label>Select a floor:</label>
    <select class="floor-drop-down" onchange="updateSlidingSelect('.select-floor','.result-classrooms');getClassrooms()">
      <option value="">--Choose One--</option>
    </select>
  </div>


<!-- add bid to the add button -->
  <div class="result-classrooms">
    <h3>Available Classrooms
      <button class="btn btn-success pull-right" onclick="loadPage('add_edit_classroom')">
      <span class="fa fa-plus-circle"></span>
      Add Classroom
    </button>
    </h3>
  </div>

</div>

<script>
  $(function(){

    //if existing classroom edit is clicked go to add edit classroom
    $("body").on("click", ".edit-classroom", function(){
      var classroomId = $(this).data("cid");
      var buildingId = $(this).data("bid");
      console.log("Got the classroom Id: " + classroomId);
      $(".content-container").load("php/add_edit_classroom.php?cid=" + classroomId + "&bid=" + buildingId);
    });
    
  });
</script>
