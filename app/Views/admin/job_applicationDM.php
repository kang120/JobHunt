<?php $this->extend("admin/layout") ?>

<?php $this->section("title") ?>
    <title>JMS - Job Application</title>
<?php $this->endSection() ?>

<?php $this->section("content") ?>
    <div style="padding: 0 50px 50px 50px;">
        <div class="searchbox">
            <div class="page-title"><b>Job Application</b></div>
            <div style="font-size: 1.2em; margin-top: 60px;">Search by
            <select id="filter-type" style="height: 30px;" oninput="search_filter()">
                <option value="application_id">Application ID</option>
                <option value="result">Result</option>
                <option value="job_name">Job ID</option>
                <option value="candidate_id">Candidate ID</option>
                <option value="company_id">Company ID</option>
            </select>
            <input id="searchbar" type="text" oninput="search_filter()"></div>
        </div>
        <div class="table-container">
            <table id="datatable" width="100%">
                <col width="5%">
                <col width="20%">
                <col width="5%">
                <col width="5%">
                <col width="5%">
                <thead>
                    <th>ID</th>
                    <th>Result</th>
                    <th>Job ID</th>
                    <th>Candidate ID</th>
                    <th>Company ID</th>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function createTable(data){
            $("#datatable tbody").html("");

            for(let i = 0; i < data.length; i++){
                let candidate = data[i];

                var row = document.createElement("tr");

                row.innerHTML += "<td style='text-align: center'>" + data[i]["APPLICATION_ID"] + "</td>";
                row.innerHTML += "<td>" + data[i]["RESULT"] + "</td>";
                row.innerHTML += "<td style='text-align: center'>" + data[i]["JOB_ID"] + "</td>";
                row.innerHTML += "<td style='text-align: center'>" + data[i]["CANDIDATE_ID"] + "</td>";
                row.innerHTML += "<td style='text-align: center'>" + data[i]["COMPANY_ID"] + "</td>";

                $("#datatable tbody").append(row);
            }
        }

        function AJAX_get_job_applications(filter){
            if(filter == ""){
                $.ajax({
                    "url": API_URL + "get_job_applications",
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
                    "url": API_URL + "get_job_applications?" + filter,
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
            AJAX_get_job_applications("");
        }

        function search_filter(){
            var filterType = $("#filter-type").val();
            var filterValue = $("#searchbar").val();

            var filter = filterType + "=" + filterValue;
            
            AJAX_get_job_applications(filter);
        }
    </script>
<?php $this->endSection() ?>