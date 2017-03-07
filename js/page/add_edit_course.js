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
                    console.log("success " + data);
                    alert('Course has been deleted.');
                    loadPage('course');
                }
                else{
				    alert(data);
			    }
            }
        });
    });
});


var formCourse = document.querySelector('#add_course');

if(formCourse) 
    formCourse.addEventListener('submit', courseCheckForm);



//Set regexValidation for each field being passed from add_edit_building
// var regexValidations = {

// };

//check form on submit
function courseCheckForm(e) {
    e.preventDefault();

    //set flag to help check validation
    var isValid = true;

    //for each field in the add_subject form the with the validate class, see if the field is empty or fails regex validation
    //if so set the isValid flag to false and add the error class to signify an error to the user else remove the error class
    // $('#add_course .validate').each(function () {
    //     //$(this).length <= 0) ||
    //     if ($(this).val() == "" || !regexValidations[this.name].test(this.value)) {
    //         $(this).parent().addClass('error');
    //         console.log($(this).val());
    //         isValid = false;
    //     }
    //     else {
    //         $(this).parent().removeClass('error');
    //     }
    // });

    //if the isValid flag gets set to false, alert the user else, send to php via ajax
    if (isValid == false) {
        alert("Please correct all fields.");
    }
    else {
        var type;
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
                courseName: $("input[name=courseName]").val(),
                courseNumber: $("input[name=courseNumber]").val(),
                creditHours: $("input[name=creditHours]").val(),
                semesterNumber: 25,
                departmentsId: $("input[name=subId]").val(),
                id: $("input[name=courseId]").val()
            },
            //if ajax is successful, return to building main page and alert the user
            success: function (data) {
                if (data !== "" && data == 'Course Added') {
                    alert("Course added successfully.")
                        loadPage('course');
                }
                else if (data !== "" && data == 'Course Updated'){
                        alert("Course updated successfully.")
                        loadPage('course');
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
