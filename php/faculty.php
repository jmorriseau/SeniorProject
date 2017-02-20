<h1>Faculty</h1>
<hr/>

 <!-- Search bar -->
        <div id="find">             
            <?php include_once("find.php"); ?>
            <input id="search-input" type="text" placeholder="Search"/>
            <div id="search-icon"></div>
        </div>

<div class="result-faculty">
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
