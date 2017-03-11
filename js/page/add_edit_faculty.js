$(function () {
//    if delete faculty button is clicked run ajax to delete faculty
    $(".edit-faculty-container .delete_faculty").on('click', function (e) {
        e.stopPropagation();
        e.preventDefault();
        var faculty_id = $(this).data("delete");
       console.log(this);
        $.ajax({
            url: "php/api/FacultyResource.php?id=" + faculty_id,
            dataType: "JSON",
            method: "DELETE",
            success: function (data) {
                if(data !== "" && data == 'Faculty Deleted'){
                    console.log(data);
                    // alert('Faculty has been deleted.');
                    // loadPage('faculty');
                    $(".faculty-modal").removeClass("error-modal");
                    $('.faculty-modal .modal-header').html("Faculty");
                    $('.faculty-modal .modal-body').html(
                        '<div class="alert-box info">' +
                            '<div class="alert-icon">' +
                                '<span class="fa fa-info-circle"></span>' +
                            '</div>' +
                            '<div class="alert-text">' +
                                "Faculty member deleted successfully." +
                            '</div>' +
                        '</div>'
                    )
                    launchModal('.faculty-modal');
                    setTimeout(function(){closeModal('.faculty-modal');loadPage('faculty')},3000);
                }
                else {
                    alert(data);
                } 
            }
        });
    });
});


var formFaculty = document.querySelector('#add_faculty');

if(formFaculty)
formFaculty.addEventListener('submit', checkForm);


//Set regexValidation for each field being passed from add_edit_building
var facultyRegexValidations = {
    "firstName": /^[a-zA-Z .\-\']*$/,
    "lastName": /^[a-zA-Z .\-\']*$/,
    "phoneNumber": /^(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$/,
    "email": /^[A-Za-z0-9@.]*$/
};

//check form on submit
function checkForm(e) {
    e.preventDefault();

    //set flag to help check validation
    var isValid = true;
    var facultyErrorList = "";

    //for each field in the add_subject form the with the validate class, see if the field is empty or fails regex validation
    //if so set the isValid flag to false and add the error class to signify an error to the user else remove the error class
    $('#add_faculty .validate').each(function () {
        if ($(this).val() == "" || !facultyRegexValidations[this.name].test(this.value)) {
            $(this).parent().addClass('error');
            console.log($(this).val());
            isValid = false;
            facultyErrorList += $(this).parent().find("label").text() + "<br /> ";
        }
        else {
            $(this).parent().removeClass('error');
        }
    });

    //if the isValid flag gets set to false, alert the user else, send to php via ajax
    if (isValid == false) {
        //alert("Please correct all fields.");
        $(".faculty-modal").addClass("error-modal");
        $('.faculty-modal .modal-header').html("Faculty");
        $('.faculty-modal .modal-body').html(

            '<div class="alert-box warning">' +
            '<div class="alert-icon">' + 
                '<span class="fa fa-exclamation-triangle"></span>' +
            '</div>' +
            '<div class="alert-text">' +
                "Please correct the following fields:<br />" +
                facultyErrorList +
            '</div>' +
            '</div>'
        )
        launchModal('.faculty-modal');
    }
    else {
        var firstName = $.trim($("input[name=firstName]").val());
        var lastName = $.trim($("input[name=lastName]").val());
        var type;
        if ($(".submit-form").hasClass("Add")) {
            type = "POST";
        }
        else {
            type = "PUT";
        }

        $.ajax({
            url: "php/api/FacultyResource.php",
            type: type,
            dataType: "JSON",
            data: {
                firstName: $.trim($("input[name=firstName]").val()),
                lastName: $.trim($("input[name=lastName]").val()),
                phoneNumber: $.trim($("input[name=phoneNumber]").val()),
                email: $.trim($("input[name=email]").val()),
                id: $("input[name=facultyId]").val()
            },
            //if ajax is successful, return to course main page and alert the user
            success: function (data) {
                if (data !== "" && data == 'Faculty Added') {
                    //alert("Faculty added successfully.")
                    $(".faculty-modal").removeClass("error-modal");
                    $('.faculty-modal .modal-header').html("Faculty");
                    $('.faculty-modal .modal-body').html(
                        '<div class="alert-box info">' +
                            '<div class="alert-icon">' +
                                '<span class="fa fa-info-circle"></span>' +
                            '</div>' +
                            '<div class="alert-text">' +
                                firstName + " " + lastName +
                                " has been added successfully." +
                            '</div>' +
                        '</div>'
                    )
                    launchModal('.faculty-modal');
                    setTimeout(function(){closeModal('.faculty-modal');loadPage('faculty')},3000);
                }
                else if (data !== "" && data == 'Faculty Updated'){
                    $(".faculty-modal").removeClass("error-modal");
                    $('.faculty-modal .modal-header').html("Faculty");
                    $('.faculty-modal .modal-body').html(
                        '<div class="alert-box info">' +
                            '<div class="alert-icon">' +
                                '<span class="fa fa-info-circle"></span>' +
                            '</div>' +
                            '<div class="alert-text">' +
                                firstName + " " + lastName + 
                                " has been updated successfully." +
                            '</div>' +
                        '</div>'
                    )
                    launchModal('.faculty-modal');
                    setTimeout(function(){closeModal('.faculty-modal');loadPage('faculty')},3000);
                } 
                else {
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
