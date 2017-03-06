<?php
include('./autoload.php');

 $db = new DAO();

 ?>

<div class="header">
  <h1>Current Curriculum
    <!--<button class="btn btn-success pull-right" onclick="loadPage('add_curriculum')">
      <span class="fa fa-plus-circle"></span>
      Add Curriculum
    </button>-->
</h1>
</div>
<hr/>

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
    Curriculum
    <!--<ul>
      <li>Quarter One
        <ul>
          <li>Computer and Networking Fundamentals</li>
          <li>Programming Essentails Using C++</li>
          <li>IT Visual Communications</li>
          <li>Intro to College Math</li>
        </ul>
      </li>
      <li>Quarter Two
        <span></span>
      </li>
      <li>Quarter Three
        <span></span>
      </li>
      <li>Quarter Four
        <span></span>
      </li>
    </ul>-->
  </div>

</div>
