<?php $this->extend("admin/layout") ?>

<?php $this->section("title") ?>
    <title>JMS - Employer</title>
<?php $this->endSection() ?>

<?php $this->section("content") ?>
    <div style="padding: 0 50px 50px 50px;">
        <div class="searchbox">
            <div class="page-title"><b>Employer</b></div>
            <div style="font-size: 1.2em; margin-top: 60px;">Search by
            <select id="filter-type" style="height: 30px;" oninput="search_filter()">
                <option value="employer_id">Employer ID</option>
                <option value="first_name">First Name</option>
                <option value="last_name">Last Name</option>
                <option value="phone">Phone</option>
                <option value="email">Email</option>
            </select>
            <input id="searchbar" type="text" oninput="search_filter()"></div>
        </div>
        <div class="table-container">
            <table id="datatable" width="100%">
                <col width="5%">
                <col width="20%">
                <col width="20%">
                <col width="20%">
                <col width="32%">
                <thead>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone</th>
                    <th>Email</th>
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
                let employer = data[i];

                var row = document.createElement("tr");

                row.innerHTML += "<td style='text-align: center'>" + data[i]["EMPLOYER_ID"] + "</td>";
                row.innerHTML += "<td>" + data[i]["FIRST_NAME"] + "</td>";
                row.innerHTML += "<td>" + data[i]["LAST_NAME"] + "</td>";
                row.innerHTML += "<td>" + data[i]["PHONE"] + "</td>";
                row.innerHTML += "<td>" + data[i]["EMAIL"] + "</td>";

                $("#datatable tbody").append(row);
            }
        }

        function AJAX_get_employers(filter){
            if(filter == ""){
                $.ajax({
                    "url": API_URL + "get_employers",
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
                    "url": API_URL + "get_employers?" + filter,
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
            AJAX_get_employers("");
        }

        function search_filter(){
            var filterType = $("#filter-type").val();
            var filterValue = $("#searchbar").val();

            var filter = filterType + "=" + filterValue;
            
            AJAX_get_employers(filter);
        }
    </script>
<?php $this->endSection() ?>