function loadPage(page){
  console.log("Getting to this function " + page);
  if(page === 'login'){
    $("#side-bar,#header").hide();
    $(".content-wrapper").addClass("full-height");
  }
  else {
    $("#side-bar,#header").show();
    $(".content-wrapper").removeClass("full-height");
  }

  $.ajax({
    method:"GET",
    url:"../php/" + page + ".php",
    success: function(result){
      $('#container').html(result);
      $("#side-bar ul li").removeClass("active");
      $(".nav-" + page).addClass("active");
    }
  });
}

function loadSubPage(subPage){
  $.ajax({
    method:"GET",
    url:"../php/" + subPage + ".php",
    success: function(result){
      $('.campus-buildings').html(result);
    }
  })
}

function validateLogin(page){
  //do js validation on the form
  //set up ajax to go to the login.php to check the db etc
  // if they have successfully logged in change pages else display errors
  loadPage(page);

}

function launchModal(section, page){
  if(section === '.edit-classroom'){
    $.ajax({
      method:"GET",
      url:"../php/" + page + ".php",
      success: function(result){
        $(section).children('.modal-body').html(result);
      }
    })
  }
  $('.modal-bg').show();
  $(section).addClass('show');
}

function closeModal(section){
  $('.modal-bg').hide();
  $(section).removeClass('show');
}

function toggleAccordian(elem){
  $(elem).next(".accordian-body").slideToggle();
  $(elem).parent().toggleClass("expanded");
  if($(elem).parent().hasClass('expanded')){
    $(elem).children("span").removeClass("fa-plus").addClass("fa-minus");
  }
  else{
    $(elem).children("span").removeClass("fa-minus").addClass("fa-plus");
  }
}

function updateSlidingSelect(current, next){
  $(current).removeClass('active').addClass('completed');
  if(next !== undefined || next !== null){
    $(next).addClass('active');
  }
}


//** function for the classroom sliders */
function getCampusBuildings(){
  var campusId = $('.campuses-drop-down').val();
  $.ajax({
      method:"GET",
      url: 'php/classroom_list.php?cid=' + campusId,
      success: function(result){
        $('.buildings-drop-down').append(result);
        $('.campuses-drop-down').attr('disabled',true);
      }
    })
}

function getBuildingFloors(){
  var buildingId = $('.buildings-drop-down').val();
  $.ajax({
      method:"GET",
      url: 'php/floor_list.php?bid=' + buildingId,
      success: function(result){
        $('.floor-drop-down').append(result);
        $('.buildings-drop-down').attr('disabled',true);
      }
    })
}

function getClassrooms(){
  var campusId = $('.campuses-drop-down').val();
  var buildingId = $('.buildings-drop-down').val();
  var floorId = $('.floor-drop-down').val();
  console.log("campus id: " + campusId + " building id: " + buildingId + " floor: " + floorId);
  $.ajax({
    method:"GET",
    url: 'php/classroom_list_full.php?cid=' + campusId + '&bid=' + buildingId + '&fid=' + floorId,
    success: function(result){
      //console.log(result);
      $('.add-avail-header').append('<button class="btn btn-success pull-right add-new-classroom" data-bid="'+buildingId+'"><span class="fa fa-plus-circle"></span>Add Classroom</button>')
      $('.result-classrooms').append(result);
      $('.floor-drop-down').attr('disabled',true);
    }
  })
}

/*** end functions for the classroom sliders */ 

/** funtions for the curriculum sliders */
function getProgram(){
  var degreeId = $('.degree-drop-down').val();
  console.log(degreeId + " is the degree ID");
  $.ajax({
    method:"GET",
    url: 'php/program_list.php?did=' + degreeId,
    success: function(result){
     // console.log(result);
     $('.program-drop-down').append(result);
     $('.degree-drop-down').attr('disabled',true);
    }
  })
}

function getStartDate(){
  var degreeId = $('.degree-drop-down').val();
  var programId = $('.program-drop-down').val();
  console.log(programId + " is the program ID");
  $.ajax({
    method:"GET",
    url: 'php/start_list.php?pid=' + programId + "&did=" + degreeId,
    success: function(result){
     // console.log(result);
     $('.start-drop-down').append(result);
     $('.program-drop-down').attr('disabled',true);
    }
  })
}

function getCurriculumList(){
  var degreeId = $('.degree-drop-down').val();
  var curriculumId = $('.start-drop-down').val();
  console.log(curriculumId + " degree id " + degreeId);
  $.ajax({
    method: "GET",
    url: 'php/curriculum_list.php?cid=' + curriculumId + "&did=" + degreeId,
    success: function(result){
      $('.result-curriculum').append(result);
      $('.start-drop-down').attr('disabled',true);
    }
  })
}

/** end funtions for the curriculum sliders */

function editCampus(elem){
  console.log(elem);
  $(".campus-container section").not(".active").addClass("inactive");
  $(elem).parent("section").removeClass("inactive").addClass("active");

  
  var campus_id = $(elem).siblings(".campus_cid").data("cid");
  console.log(campus_id);
  return campus_id;
}

function closeEdit(){
  $(".campus-container section").removeClass("active inactive");
  $(".campus-container").css({"height": "400px", "background-color": "transparent"});
}


function deleteAlert(){
  alert("Are you sure?");
}


var campuses = [
  {
    "campusName": "Access Road",
    "buildings":[
      {
        "name": "North Building",
        "addressLineOne" : "123 Access Road",
        "addressLineTwo" : "Suite 200",
        "city" : "Warwick",
        "state" : "RI",
        "zipCode" : "02709"
      },
      {
        "name": "South Building",
        "addressLineOne" : "123 Access Road",
        "addressLineTwo" : "Suite 300",
        "city" : "Warwick",
        "state" : "RI",
        "zipCode" : "02709"
      }
    ]
  },
  {
    "campusName" : "East Greenwich",
    "buildings" : [
      {
        "name" : "East Building",
        "addressLineOne" : "123 NE Tech Way",
        "addressLineTwo" : "Suite 100",
        "city" : "East Greenwich",
        "state" : "RI",
        "zipCode" : "02710"
      },
      {
        "name" : "West Building",
        "addressLineOne" : "123 NE Tech Way",
        "addressLineTwo" : "Suite 200",
        "city" : "East Greenwich",
        "state" : "RI",
        "zipCode" : "02710"
      }
    ]
  },
  {
    "campusName" : "Post Road",
    "buildings" : [
      {
        "name" : "Sun Building",
        "addressLineOne" : "123 Post Road",
        "addressLineTwo" : "Suite 100",
        "city" : "Warwick",
        "state" : "RI",
        "zipCode" : "02710"
      },
      {
        "name" : "Moon Building",
        "addressLineOne" : "123 Post Road",
        "addressLineTwo" : "Suite 200",
        "city" : "Warwick",
        "state" : "RI",
        "zipCode" : "02710"
      }
    ]
  }
]
