<?php
include('./autoload.php');

$db = new DAO();
$faculty = array();

$faculty = $db->sql("SELECT * FROM Faculty ORDER BY last_name");
/*
$count = array();
$Holder = array();
$sql_statement = array();

$enrollment = $db->sql("SELECT course_id, count(course_id) as total FROM Enrollment GROUP BY course_id ORDER BY total desc;");

foreach ($enrollment as $header => $value) {
  foreach ($enrollment as $value => $thing) {
    $cid = $thing['course_id'] ;
    $ctot = $thing['total'];
    $count += [$cid => $ctot];
    }
}

var_dump($count);
echo "\n\n --------------------------------------------------------------------------------------------------------------------";
//var_dump($id_key);
*/

?>

<div class="header">
  <h1>Faculty
    <button class="btn btn-success pull-right" onclick="loadPage('add_edit_faculty')">
      <span class="fa fa-plus-circle"></span>
      Add Faculty
    </button>
</h1>
</div>
<hr/>

 <!-- Search bar -->
<div id="find">
    <?php include_once("find.php"); ?>
    <input id="search-input" type="text" placeholder="Search"/>
    <div id="search-icon"></div>
</div>

<div class="result-faculty">
  <?php
    if(count($faculty) > 0){
      echo '<ul>';
          foreach($faculty as $sr){
              echo '<li class="edit-faculty" data-fid="' .$sr[faculty_id]. '">'. $sr[first_name] . ' ' . $sr[last_name] . '<span class="pull-right">Edit</span></li>';
          }
      echo '</ul>';
    }
  ?>
</div>

<script>
  $(function(){
    //run search faculty when search icon is clicked
      $("#search-icon").on("click",function(){
        var searchCriteria = $("#search-input").val();
        console.log(searchCriteria);
        $(".result-faculty").load('php/faculty_list.php?sc=' + searchCriteria);
      });

    //run search faculty when letter is clicked
      $("#alphabet-search li").on("click", function() {
        var searchCriteria = $(this).html();
        console.log(searchCriteria);
        $(".result-faculty").load('php/faculty_list.php?sc=' + searchCriteria);
    });

    //if existing faculty edit is clicked go to add edit faulty
    $("body").on("click", ".edit-faculty", function(){
      var facultyId = $(this).data("fid");
      console.log("Got the faculty Id: " + facultyId);
      $(".content-container").load("php/add_edit_faculty.php?fid=" + facultyId);
    });

  });
</script>
