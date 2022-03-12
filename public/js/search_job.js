function jobtype_onclick(row){
    // uncheck all checkbox first
    var jobtype_checkboxes = document.getElementsByClassName("jobtype-checkbox");

    for(let i = 0; i < jobtype_checkboxes.length; i++){
        jobtype_checkboxes[i].checked = false;
    }

    // check the selected checkbox
    row.childNodes[1].checked = true;

    $("#jobtype").val(row.childNodes[1].value);
    $("#jobtype-form").submit();
}