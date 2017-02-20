<?php
include('./autoload.php');


$db = new DAO();
$faculty = array();

$faculty = $db->sql("SELECT * FROM Faculty ORDER BY last_name");
?>

<h1>Faculty</h1>
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
                echo '<li data-fid="' .$sr[faculty_id]. '">'. $sr[first_name] . ' ' . $sr[last_name] . '<span class="pull-right"x>Edit | Delete</span></li>';
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
    
  });
</script>
