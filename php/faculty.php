<?php
include('./autoload.php');

$db = new DAO();
$faculty = array();

$faculty = $db->sql("SELECT * FROM Faculty ORDER BY last_name");
/*$count = array();
$id_key = array();
$holder = array();
$enrol_total = array();
//$count['test'] = 1;

$enrollment = $db->sql("SELECT course_id FROM Enrollment");

foreach ($enrollment as $header => $value) {
  $i = 0;
  foreach ($enrollment as $value => $thing) {
    $cid = $thing['course_id'] ;
    $holder[$i] = $cid;
    $i++;
    }
}
$ie = 0;
foreach($holder as $cur_val){

  if(array_key_exists($cur_val, $count) === true){
    $count[$cur_val] = $count[$cur_val] + 1;
  }
  else {
    $count[$cur_val] = 1;
    $id_key[$ie] = $cur_val;
  }
  $ie++;
}

$if = 0;
foreach($count as $total){

}

//array_multisort($count, SORT_DESC);

var_dump($count);
echo "\n\n -------------------------------------------------------------------------";
var_dump($id_key);
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
