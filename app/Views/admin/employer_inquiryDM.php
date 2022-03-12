<?php $this->extend("admin/layout") ?>

<?php $this->section("title") ?>
    <title>JMS - Employer Inquiry</title>
<?php $this->endSection() ?>

<?php $this->section("content") ?>
    <div id="container" style="padding: 0 50px 50px 50px;">
        <div class="searchbox">
            <div class="page-title"><b>Employer Inquiry</b></div>
            <div style="font-size: 1.2em; margin-top: 60px;">Search by
            <select id="filter-type" style="height: 30px;" oninput="search_filter()">
                <option value="inquiry_id">Inquiry ID</option>
                <option value="question">Question</option>
                <option value="answer">Answer</option>
                <option value="employer_id">Employer ID</option>
                <option value="admin_id">Admin ID</option>
            </select>
            <input id="searchbar" type="text" oninput="search_filter()"></div>
        </div>
        <div class="table-container">
            <table id="datatable" width="100%">
                <col width="5%">
                <col width="37%">
                <col width="37%">
                <col width="10%">
                <col width="10%">
                <thead>
                    <th>ID</th>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>Employer ID</th>
                    <th>Admin ID</th>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <form method="POST" id="reply-modal" class="reply-modal">
        <div style="font-size: 1.5em"><b>Question</b></div>
        <div id="question-box"></div>
        <div style="font-size: 1.5em; margin-top: 50px"><b>Reply</b></div>
        <textarea name="reply" id="reply-box"></textarea>
        <div style="width: 100%; display: flex; align-items: center; justify-content: center; margin-top: 50px">
            <input id="inquiry-id" name="inquiry_id" hidden>
            <button class="btn btn-success">Submit</button>
            <button class="btn btn-primary" style="margin-left: 20px" type="button" onclick="closeReplyModal()">Cancel</button>
        </div>
    </form>

    <script>
        function createTable(data){
            $("#datatable tbody").html("");

            for(let i = 0; i < data.length; i++){
                let candidate = data[i];

                var row = document.createElement("tr");

                row.innerHTML += "<td style='text-align: center'>" + data[i]["INQUIRY_ID"] + "</td>";
                row.innerHTML += "<td>" + data[i]["QUESTION"] + "</td>";
                row.innerHTML += "<td>" + data[i]["ANSWER"] + "</td>";
                row.innerHTML += "<td style='text-align: center'>" + data[i]["EMPLOYER_ID"] + "</td>";

                if(data[i]["ANSWER"] != null){
                    row.innerHTML += "<td style='text-align: center'>" + data[i]["ADMIN_ID"] + "</td>";
                }else{
                    var inquiry_id = data[i]["INQUIRY_ID"];
                    var question = data[i]["QUESTION"];

                    row.innerHTML += "<input id='question-" + inquiry_id + "' value='" + question + "' hidden>";
                    row.innerHTML += "<td style='text-align: center'>" + "<button class='btn btn-success' onclick=openReplyModal(" + inquiry_id + ")>Reply</button>" + "</td>";
                }

                $("#datatable tbody").append(row);
            }
        }

        function AJAX_get_employer_inquiries(filter){
            if(filter == ""){
                $.ajax({
                    "url": API_URL + "get_employer_inquiries",
                    "method": "GET",
                    "success": function(data){
                        createTable(data);
                    },
                    "error": function(){
                        console.log("Something error");
                    }
                });
            }else{
                $.ajax({
                    "url": API_URL + "get_employer_inquiries?" + filter,
                    "method": "GET",
                    "success": function(data){
                        createTable(data);
                    },
                    "error": function(){
                        console.log("Something error");
                    }
                });
            }
        }

        window.onload = function(){
            AJAX_get_employer_inquiries("");
        }

        function search_filter(){
            var filterType = $("#filter-type").val();
            var filterValue = $("#searchbar").val();

            var filter = filterType + "=" + filterValue;
            
            AJAX_get_employer_inquiries(filter);
        }
    </script>
<?php $this->endSection() ?>