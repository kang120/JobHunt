<?php $this->extend("admin/layout") ?>

<?php $this->section("title") ?>
    <title>JMS - Job</title>
<?php $this->endSection() ?>

<?php $this->section("content") ?>
    <div style="padding: 0 50px 50px 50px;">
        <div class="searchbox">
            <div class="page-title"><b>Job</b></div>
            <div style="font-size: 1.2em; margin-top: 60px;">Search by
            <select id="filter-type" style="height: 30px;" oninput="search_filter()">
                <option value="job_id">Job ID</option>
                <option value="title">Title</option>
                <option value="salary">Salary</option>
                <option value="type">Type</option>
                <option value="specialization">Specialization</option>
                <option value="company_id">Company ID</option>
            </select>
            <input id="searchbar" type="text" oninput="search_filter()"></div>
        </div>
        <div class="table-container">
            <table id="datatable" width="100%">
                <col width="5%">
                <col width="20%">
                <col width="20%">
                <col width="15%">
                <col width="25%">
                <col width="10%">
                <thead>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Salary</th>
                    <th>Type</th>
                    <th>Specialization</th>
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
                let job = data[i];

                var row = document.createElement("tr");

                row.innerHTML += "<td style='text-align: center'>" + data[i]["JOB_ID"] + "</td>";
                row.innerHTML += "<td>" + data[i]["TITLE"] + "</td>";
                row.innerHTML += "<td>" + data[i]["SALARY"] + "</td>";
                row.innerHTML += "<td>" + data[i]["TYPE"] + "</td>";
                row.innerHTML += "<td>" + data[i]["SPECIALIZATION"] + "</td>";
                row.innerHTML += "<td style='text-align: center'>" + data[i]["COMPANY_ID"] + "</td>";

                $("#datatable tbody").append(row);
            }
        }

        function AJAX_get_jobs(filter){
            if(filter == ""){
                $.ajax({
                    "url": API_URL + "get_jobs",
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
                    "url": API_URL + "get_jobs?" + filter,
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
            AJAX_get_jobs("");
        }

        function search_filter(){
            var filterType = $("#filter-type").val();
            var filterValue = $("#searchbar").val();

            var filter = filterType + "=" + filterValue;
            
            AJAX_get_jobs(filter);
        }
    </script>
<?php $this->endSection() ?>