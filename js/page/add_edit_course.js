$(function () {
//    if delete course button is clicked run ajax to delete course
    $(".delete_course").on('click', function (e) {
        e.stopPropagation();
        e.preventDefault();
        var course_id = $(this).data("delete");
        $.ajax({
            url: "php/api/CourseResource.php?id=" + course_id,
            dataType: "JSON",
            method: "DELETE",
            success: function (data) {
                if(data !== "" && data == 'Course Deleted'){
                    // console.log("success " + data);
                    // alert('Course has been deleted.');
                    // loadPage('course');
                    $(".course-modal").removeClass("error-modal");
                    $('.course-modal .modal-header').html("Course");
                    $('.course-modal .modal-body').html(
                        '<div class="alert-box info">' +
                            '<div class="alert-icon">' +
                                '<span class="fa fa-info-circle"></span>' +
                            '</div>' +
                            '<div class="alert-text">' +
                                "Course deleted successfully." +
                            '</div>' +
                        '</div>'
                    )
                    launchModal('.course-modal');
                    setTimeout(function(){closeModal('.course-modal');loadPage('course')},3000);
                }
                else{
				    alert(data);
			    }
            }
        });
    });
});

console.log("here in form course");
var formCourse = document.querySelector('#add_course');

if(formCourse) 
    formCourse.addEventListener('submit', courseCheckForm);

//Set regexValidation for each field being passed from add_edit_building
var courseRegexValidations = {
    "courseName":/^[a-zA-Z 0-9]*$/,
    "courseNumber": /^[a-zA-Z 0-9]*$/,
    "creditHours": /^[0-9.]*$/

};

//check form on submit
function courseCheckForm(e) {
    e.preventDefault();
    console.log("in the check form for course");
    //set flag to help check validation
    var isValid = true;
    var courseErrorList = "";

    //for each field in the add_subject form the with the validate class, see if the field is empty or fails regex validation
    //if so set the isValid flag to false and add the error class to signify an error to the user else remove the error class
    $('#add_course .validate').each(function () {
        //$(this).length <= 0) ||
        if ($(this).val() == "" || !courseRegexValidations[this.name].test(this.value)) {
            $(this).parent().addClass('error');
            console.log($(this).val());
            isValid = false;
            courseErrorList += $(this).parent().find("label").text() + "<br /> ";
        }
        else {
            $(this).parent().removeClass('error');
        }
    });

    //if the isValid flag gets set to false, alert the user else, send to php via ajax
    if (isValid == false) {
        //alert("Please correct all fields.");
        $(".course-modal").addClass("error-modal");
        $('.course-modal .modal-header').html("Course");
        $('.course-modal .modal-body').html(

            '<div class="alert-box warning">' +
            '<div class="alert-icon">' + 
                '<span class="fa fa-exclamation-triangle"></span>' +
            '</div>' +
            '<div class="alert-text">' +
                "Please correct the following fields:<br />" +
                courseErrorList +
            '</div>' +
            '</div>'
        )
        launchModal('.course-modal');
    }
    else {
        var type;
        var courseName = $.trim($("input[name=courseName]").val())
        if ($(".submit-form").hasClass("Add")) {
            type = "POST";
        }
        else {
            type = "PUT";
        }
        //alert("subject is " + $("input[name=subId]").val());
        $.ajax({
            url: "php/api/CourseResource.php",
            type: type,
            dataType: "JSON",
            data: {
                courseName: courseName,
                courseNumber: $.trim($("input[name=courseNumber]").val()),
                creditHours: $.trim($("input[name=creditHours]").val()),
                semesterNumber: 25,
                departmentsId: $("input[name=subId]").val(),
                id: $("input[name=courseId]").val()
            },
            //if ajax is successful, return to building main page and alert the user
            success: function (data) {
                if (data !== "" && data == 'Course Added') {
                    // alert("Course added successfully.")
                    //     loadPage('course');
                    $(".course-modal").removeClass("error-modal");
                    $('.course-modal .modal-header').html("Course");
                    $('.course-modal .modal-body').html(
                        '<div class="alert-box info">' +
                            '<div class="alert-icon">' +
                                '<span class="fa fa-info-circle"></span>' +
                            '</div>' +
                            '<div class="alert-text">' +
                                 "Course " + courseName +
                                " has been added successfully." +
                            '</div>' +
                        '</div>'
                    )
                    launchModal('.course-modal');
                    setTimeout(function(){closeModal('.course-modal');loadPage('course')},3000);
                }
                else if (data !== "" && data == 'Course Updated'){
                        // alert("Course updated successfully.")
                        // loadPage('course');
                    $(".course-modal").removeClass("error-modal");
                    $('.course-modal .modal-header').html("Course");
                    $('.course-modal .modal-body').html(
                        '<div class="alert-box info">' +
                            '<div class="alert-icon">' +
                                '<span class="fa fa-info-circle"></span>' +
                            '</div>' +
                            '<div class="alert-text">' +
                                "Course " + courseName + 
                                " has been updated successfully." +
                            '</div>' +
                        '</div>'
                    )
                    launchModal('.course-modal');
                    setTimeout(function(){closeModal('.course-modal');loadPage('course')},3000);
                } 
                else{
				    alert(data);
			    }
            },
            //if ajax is unsuccessful, show response text in console
            error: function (data) {
                console.log(data.responseText);
            }
        });
    }

}
