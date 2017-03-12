$(function () {
//    if delete contact  button is clicked run ajax to delete contact
    $(".delete_building").on('click', function (e) {
        e.stopPropagation();
        e.preventDefault();
        var file_name = $(this).data("delete");
        $.ajax({
            url: "php/api/BuildingResource.php?id=" + building_id,
            dataType: "JSON",
            method: "DELETE",
            success: function (data) {
                if(data !== "" && data == 'Building Deleted'){
                    console.log("success " + data);
                alert('Building has been deleted.');
                loadPage('building');
                }
                else{
                    alert(data);
                }
            }
        });
    });

});
