$(function () {
//    if delete department(subject) button is clicked run ajax to delete department(subject)
    $(".delete_subject").on('click', function (e) {
        e.stopPropagation();
        e.preventDefault();
        var department_id = $(this).data("delete");
        $.ajax({
            url: "php/api/DepartmentResource.php?id=" + department_id,
            dataType: "JSON",
            method: "DELETE",
            success: function (data) {
                if(data !== "" && data == 'Department Deleted'){
                    // console.log("success " + data);
                    // alert('Subject has been deleted.');
                    // loadPage('course');
                    $(".subject-modal").removeClass("error-modal");
                     $('.subject-modal .modal-header').html("Subject");
                        $('.subject-modal .modal-body').html(
                            '<div class="alert-box info">' +
                                '<div class="alert-icon">' +
                                    '<span class="fa fa-info-circle"></span>' +
                                '</div>' +
                                '<div class="alert-text">' +
                                    "Subject deleted successfully." +
                                '</div>' +
                            '</div>'
                        )
                        launchModal('.subject-modal');
                        setTimeout(function(){closeModal('.subject-modal');loadPage('course')},3000);
                }
                else {
                    alert(data);
                }
            }
        });
    });
});


var formSubject = document.querySelector('#add_subject');

if(formSubject)
formSubject.addEventListener('submit', checkForm);


//Set regexValidation for each field being passed from add_edit_building
var subjectRegexValidations = {
    "subjectName": /^[a-zA-Z0-9]*$/
};

//check form on submit
function checkForm(e) {
    e.preventDefault();

    //set flag to help check validation
    var isValid = true;
    var subjectErrorList = "";

    //for each field in the add_subject form the with the validate class, see if the field is empty or fails regex validation
    //if so set the isValid flag to false and add the error class to signify an error to the user else remove the error class
    $('#add_subject .validate').each(function () {
        //$(this).length <= 0) ||
        if ($(this).val() == "" || !subjectRegexValidations[this.name].test(this.value)) {
            $(this).parent().addClass('error');
            console.log($(this).val());
            isValid = false;
            subjectErrorList += $(this).parent().find("label").text() + "<br /> ";
        }
        else {
            $(this).parent().removeClass('error');
        }
    });

    //if the isValid flag gets set to false, alert the user else, send to php via ajax
    if (isValid == false) {
        //alert("Please correct all fields.");
        $(".subject-modal").addClass("error-modal");
        $('.subject-modal .modal-header').html("Subject");
        $('.subject-modal .modal-body').html(

            '<div class="alert-box warning">' +
            '<div class="alert-icon">' + 
                '<span class="fa fa-exclamation-triangle"></span>' +
            '</div>' +
            '<div class="alert-text">' +
                "Please correct the following fields <br />" +
                subjectErrorList +
            '</div>' +
            '</div>'
        )
        launchModal('.subject-modal');
    }
    else {
        var type;
        var subjectName = $.trim($("input[name=subjectName]").val());
        if ($(".submit-form").hasClass("Add")) {
            type = "POST";
        }
        else {
            type = "PUT";
        }
        //alert("Type: " + type + $("input[name=subjectId]").val());
        $.ajax({
            url: "php/api/DepartmentResource.php",
            type: type,
            dataType: "JSON",
            data: {
                subjectName: subjectName,
                id: $("input[name=subjectId]").val()
            },
            //if ajax is successful, return to course main page and alert the user
            success: function (data) {
                if (data !== "" && data == 'Department Added') {
                    // alert("Subject added successfully.")
                    //     loadPage('course');
                    $(".subject-modal").removeClass("error-modal");
                    $('.subject-modal .modal-header').html("Subject");
                    $('.subject-modal .modal-body').html(
                        '<div class="alert-box info">' +
                            '<div class="alert-icon">' +
                                '<span class="fa fa-info-circle"></span>' +
                            '</div>' +
                            '<div class="alert-text">' +
                                 "Subject " + subjectName +
                                " has been added successfully." +
                            '</div>' +
                        '</div>'
                    )
                    launchModal('.subject-modal');
                    setTimeout(function(){closeModal('.subject-modal');loadPage('course')},3000);
                }
                else if (data !== "" && data == 'Department Updated'){
                        // alert("Subject updated successfully.")
                        // loadPage('course');
                    $(".subject-modal").removeClass("error-modal");
                    $('.subject-modal .modal-header').html("Subject");
                    $('.subject-modal .modal-body').html(
                        '<div class="alert-box info">' +
                            '<div class="alert-icon">' +
                                '<span class="fa fa-info-circle"></span>' +
                            '</div>' +
                            '<div class="alert-text">' +
                                 "Subject " + subjectName + 
                                " has been updated successfully." +
                            '</div>' +
                        '</div>'
                    )
                    launchModal('.subject-modal');
                    setTimeout(function(){closeModal('.subject-modal');loadPage('course')},3000);
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
