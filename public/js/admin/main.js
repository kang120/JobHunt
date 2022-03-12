API_URL = "http://localhost:2175/";
BASE_URL = "http://localhost/JobHunt/public/";

function sign_out(){
    window.location.href = BASE_URL + "admin/signout";
}

function openReplyModal(inquiry_id){
    var inquiry_question = $("#question-" + inquiry_id).val();

    $("#container").css("opacity", 0.5);
    $("#container *").prop("disabled", true);

    $("#inquiry-id").val(inquiry_id);
    $("#question-box").html(inquiry_question);

    $("#reply-modal").css("display", "block");
}

function closeReplyModal(){
    $("#container").css("opacity", 1);
    $("#container *").prop("disabled", false);

    $("#reply-modal").css("display", "none");
}