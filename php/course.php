<<?php

 ?>

<div class="header">
  <h1>Current Courses
    <button class="btn btn-success pull-right btn-pad" onclick="loadPage('add_edit_subject')">
      <span class="fa fa-plus-circle"></span>
      Add Subject
    </button>
    <button class="btn btn-success pull-right" onclick="loadPage('add_edit_course')">
      <span class="fa fa-plus-circle"></span>
      Add Course
    </button>
    <!--<span class="fa fa-plus-square pull-right" onclick="loadPage('add_edit_subject')"> Add Subject</span>
    <span class="fa fa-plus-square pull-right" onclick="loadPage('add_edit_course')"> Add Course</span>-->
</h1>
</div>
<hr/>


<div class="accordian-container collapsed">
  <div class="accordian-header" onclick="toggleAccordian(this)">
    <span class="fa fa-plus"></span>
    English
  </div>
  <div class="accordian-body">
    English 101
  </div>
</div>

<div class="accordian-container collapsed">
  <div class="accordian-header" onclick="toggleAccordian(this)">
    <span class="fa fa-plus"></span>
    Math
  </div>
  <div class="accordian-body">
    Math 101
  </div>
</div>

<div class="accordian-container collapsed">
  <div class="accordian-header" onclick="toggleAccordian(this)">
    <span class="fa fa-plus"></span>
    Science
  </div>
  <div class="accordian-body">
    Science 101
  </div>
</div>
