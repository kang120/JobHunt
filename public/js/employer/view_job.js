function showApplicantModal(){
    $("#applicant-modal").css("display", "block");
    $("#job-container").css("opacity", 0.6);
    $("#job-container *").prop("disabled", true);
}

function closeApplicantModal(){
    $("#applicant-modal").css("display", "none");
    $("#job-container").css("opacity", 1);
    $("#job-container *").prop("disabled", false);

    window.location.reload();
}

function acceptApplicant(index){
    $("#status-" + index).val("Success");

    var buttons = document.getElementsByClassName("status-btn");

    buttons[0].classList.add("btn-success");
    buttons[1].classList.remove("btn-primary");
    buttons[2].classList.remove("btn-danger");
}

function pendingApplicant(index){
    $("#status-" + index).val("Pending");

    var buttons = document.getElementsByClassName("status-btn");

    buttons[0].classList.remove("btn-success");
    buttons[1].classList.add("btn-primary");
    buttons[2].classList.remove("btn-danger");
}

function rejectApplicant(index){
    $("#status-" + index).val("Rejected");

    var buttons = document.getElementsByClassName("status-btn");

    buttons[0].classList.remove("btn-success");
    buttons[1].classList.remove("btn-primary");
    buttons[2].classList.add("btn-danger");
}

function saveApplicationResult(){
    var status = document.getElementsByName("status");

    var resultArray = [];

    status.forEach(s => {
        resultArray.push(s.value);
    });

    var applicationStatus = resultArray.join(",");
    console.log(applicationStatus);

    $("#application_status").val(applicationStatus);
    $("#status-form").submit();
}