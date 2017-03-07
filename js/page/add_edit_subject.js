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
                    console.log("success " + data);
                    alert('Subject has been deleted.');
                    loadPage('course');
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
var regexValidations = {
    "subjectName": /^[a-zA-Z0-9]*$/
};

//check form on submit
function checkForm(e) {
    e.preventDefault();

    //set flag to help check validation
    var isValid = true;

    //for each field in the add_subject form the with the validate class, see if the field is empty or fails regex validation
    //if so set the isValid flag to false and add the error class to signify an error to the user else remove the error class
    $('#add_subject .validate').each(function () {
        //$(this).length <= 0) ||
        if ($(this).val() == "" || !regexValidations[this.name].test(this.value)) {
            $(this).parent().addClass('error');
            console.log($(this).val());
            isValid = false;
        }
        else {
            $(this).parent().removeClass('error');
        }
    });

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
        //alert("Type: " + type + $("input[name=subjectId]").val());
        $.ajax({
            url: "php/api/DepartmentResource.php",
            type: type,
            dataType: "JSON",
            data: {
                subjectName: $("input[name=subjectName]").val(),
                id: $("input[name=subjectId]").val()
            },
            //if ajax is successful, return to course main page and alert the user
            success: function (data) {
                if (data !== "" && data == 'Department Added') {
                    alert("Subject added successfully.")
                        loadPage('course');
                }
                else if (data !== "" && data == 'Department Updated'){
                        alert("Subject updated successfully.")
                        loadPage('course');
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
