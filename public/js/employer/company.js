function showAddJobModal(){
    $("#container").css("opacity", 0.6);
    $("#container *").prop("disabled", true);

    $("#add-job-modal").css("display", "block");
}

function closeAddJobModal(){
    $("#container").css("opacity", 1);
    $("#container *").prop("disabled", false);

    $("#add-job-modal").css("display", "none");
}

function uploadCompanyPicture(){
    $('#company-picture').change(function(){
        $("#upload-picture").submit();
    });

    $('#company-picture').click();
}

function openEditCompanyForm(){
    $("#company-info").css("display", "none");
    $("#open-edit-btn").css("display", "none");

    $("#edit-company-info").css("display", "block");
    $("#action-btn").css("display", "block");
}

function closeEditCompanyForm(){
    $("#company-info").css("display", "block");
    $("#open-edit-btn").css("display", "block");

    $("#edit-company-info").css("display", "none");
    $("#action-btn").css("display", "none");
}

function addScope(){
    var newScope = document.createElement("div");
    newScope.style.position = "relative";
    newScope.style.marginTop = "5px";
    newScope.style.height = "30px";
    newScope.style.padding = "0";

    var input = document.createElement("input");
    input.name = "scope[]";
    input.style.width = "100%";
    input.style.display = "block";
    input.style.paddingLeft = "40px";
    input.type = "text";


    var icon = document.createElement("ion-icon");
    icon.name = 'close-circle-outline';
    icon.className = 'close-icon';
    icon.onclick = function(){
        newScope.remove();
    }

    newScope.append(input);
    newScope.append(icon);

    $("#scope-box").append(newScope);
}

function addRequirement(){
    var newRequirement = document.createElement("div");
    newRequirement.style.position = "relative";
    newRequirement.style.marginTop = "5px";
    newRequirement.style.height = "30px";
    newRequirement.style.padding = "0";

    var input = document.createElement("input");
    input.name = "requirement[]";
    input.style.width = "100%";
    input.style.display = "block";
    input.style.paddingLeft = "40px";
    input.type = "text";

    var icon = document.createElement("ion-icon");
    icon.name = 'close-circle-outline';
    icon.className = 'close-icon';
    icon.onclick = function(){
        newRequirement.remove();
    }

    newRequirement.append(input);
    newRequirement.append(icon);

    $("#requirement-box").append(newRequirement);
}

function removeScope(index){
    $("#scope-" + index).remove();
}

function removeRequirement(index){
    $("#requirement-" + index).remove();
}

function deleteJob(index){
    if(confirm("Are you sure to delete job?")){
        $("#delete-form-" + index).submit();
    }
}