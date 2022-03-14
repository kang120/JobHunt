function showAddCompanyModal(){
    $("#container").css("opacity", 0.6);
    $("#container *").prop("disabled", true);

    $("#add-company-modal").css("display", "block");
}

function closeAddCompanyModal(){
    $("#container").css("opacity", 1);
    $("#container *").prop("disabled", false);

    $("#add-company-modal").css("display", "none");
}

function changeCompanyPicture(){
    $("#photo").change(function(){
        var file = $("#photo").prop("files")[0];
        
        var reader = new FileReader();

        reader.onload = function(e){
            $("#company-photo").attr("src", e.target.result);
        }

        reader.readAsDataURL(file);
    });

    $("#photo").click();
}

function deleteCompany(index){
    if(confirm("Are you sure to delete company?")){
        $("#delete-form-" + index).submit();
    }
}