<?php $this->extend("admin/layout") ?>

<?php $this->section("title") ?>
    <title>JMS - Company</title>
<?php $this->endSection() ?>

<?php $this->section("content") ?>
    <div style="padding: 0 50px 50px 50px;">
        <div class="searchbox">
            <div class="page-title"><b>Company</b></div>
            <div style="font-size: 1.2em; margin-top: 60px;">Search by
            <select id="filter-type" style="height: 30px;" oninput="search_filter()">
                <option value="company_id">Company ID</option>
                <option value="name">Name</option>
                <option value="location">Location</option>
                <option value="industry">Industry</option>
                <option value="size">Size</option>
                <option value="employer_id">Employer ID</option>
            </select>
            <input id="searchbar" type="text" oninput="search_filter()"></div>
        </div>
        <div class="table-container">
            <table id="datatable" width="100%">
                <col width="5%">
                <col width="20%">
                <col width="20%">
                <col width="25%">
                <col width="15%">
                <col width="10%">
                <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Industry</th>
                    <th>Size</th>
                    <th>Employer ID</th>
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
                let company = data[i];

                var row = document.createElement("tr");

                row.innerHTML += "<td style='text-align: center'>" + data[i]["COMPANY_ID"] + "</td>";
                row.innerHTML += "<td>" + data[i]["NAME"] + "</td>";
                row.innerHTML += "<td>" + data[i]["LOCATION"] + "</td>";
                row.innerHTML += "<td>" + data[i]["INDUSTRY"] + "</td>";
                row.innerHTML += "<td>" + data[i]["SIZE"] + "</td>";
                row.innerHTML += "<td style='text-align: center'>" + data[i]["EMPLOYER_ID"] + "</td>";

                $("#datatable tbody").append(row);
            }
        }

        function AJAX_get_companies(filter){
            if(filter == ""){
                $.ajax({
                    "url": API_URL + "get_companies",
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
                    "url": API_URL + "get_companies?" + filter,
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
            AJAX_get_companies("");
        }

        function search_filter(){
            var filterType = $("#filter-type").val();
            var filterValue = $("#searchbar").val();

            var filter = filterType + "=" + filterValue;
            
            AJAX_get_companies(filter);
        }
    </script>
<?php $this->endSection() ?>