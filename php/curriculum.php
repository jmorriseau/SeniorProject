<?php
include('./autoload.php');

 $db = new DAO();

 ?>

<div class="header">
  <h1>Current Curriculum
</h1>
</div>
<hr/>
<span class="fa fa-times pull-right" onclick="loadPage('curriculum')"></span>

<div class="curriculum-container content-container">

  <div class="curriculum-selector select-degree">
    <label>Select a degree:</label>
    <select class="degree-drop-down" onchange="updateSlidingSelect('.select-degree','.select-program');getProgram()">
      <option value="">--Choose One--</option>
      <option value="1">Associate</option>
      <option value="2">Bachelor</option>
      <option value="3">Master</option>
    </select>
  </div>

  <div class="curriculum-selector select-program">
    <label>Select a program:</label>
    <select class="program-drop-down" onchange="updateSlidingSelect('.select-program','.select-start');getStartDate()">
      <option value="">--Choose One--</option>
    </select>
  </div>

  <div class="curriculum-selector select-start">
    <label>Select a enrollment start:</label>
    <select class="start-drop-down" onchange="updateSlidingSelect('.select-start','.result-curriculum');getCurriculumList()">
      <option value="">--Choose One--</option>
    </select>
  </div>

  <div class="result-curriculum">
  </div>

</div>
