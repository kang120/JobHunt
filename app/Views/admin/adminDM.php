<?php $this->extend("admin/layout") ?>

<?php $this->section("title") ?>
    <title>JMS - Admin</title>
<?php $this->endSection() ?>

<?php $this->section("content") ?>
    <div style="padding: 0 50px 50px 50px;">
        <div class="searchbox">
            <div class="page-title"><b>Admin</b></div>
            <div style="font-size: 1.2em; margin-top: 60px;">Search by
            <select id="filter-type" style="height: 30px;" oninput="search_filter()">
                <option value="admin_id">Admin ID</option>
                <option value="name">Name</option>
            </select>
            <input id="searchbar" type="text" oninput="search_filter()"></div>
        </div>
        <div class="table-container">
            <table id="datatable" width="50%">
                <col width="5%">
                <col width="30%">
                <thead>
                    <th>ID</th>
                    <th>Name</th>
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

                row.innerHTML += "<td style='text-align: center'>" + data[i]["ADMIN_ID"] + "</td>";
                row.innerHTML += "<td>" + data[i]["NAME"] + "</td>";

                $("#datatable tbody").append(row);
            }
        }

        function AJAX_get_admins(filter){
            if(filter == ""){
                $.ajax({
                    "url": API_URL + "get_admins",
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
                    "url": API_URL + "get_admins?" + filter,
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
            AJAX_get_admins("");
        }

        function search_filter(){
            var filterType = $("#filter-type").val();
            var filterValue = $("#searchbar").val();

            var filter = filterType + "=" + filterValue;
            
            AJAX_get_admins(filter);
        }
    </script>
<?php $this->endSection() ?>