<?php $this->extend("admin/layout") ?>

<?php $this->section("title") ?>
    <title>JMS - Candidate Profile</title>
<?php $this->endSection() ?>

<?php $this->section("content") ?>
    <div style="padding: 0 50px 50px 50px;">
        <div class="searchbox">
            <div class="page-title"><b>Candidate Profile</b></div>
            <div style="font-size: 1.2em; margin-top: 60px;">Search by
            <select id="filter-type" style="height: 30px;" oninput="search_filter()">
                <option value="profile_id">Profile ID</option>
                <option value="education">Education</option>
                <option value="experience">Experience</option>
                <option value="skills">Skills</option>
                <option value="languages">Languages</option>
                <option value="candidate_id">Candidate ID</option>
            </select>
            <input id="searchbar" type="text" oninput="search_filter()"></div>
        </div>
        <div class="table-container">
            <table id="datatable" width="100%">
                <col width="5%">
                <col width="30%">
                <col width="30%">
                <col width="15%">
                <col width="10%">
                <col width="10%">
                <thead>
                    <th>ID</th>
                    <th>Education</th>
                    <th>Experience</th>
                    <th>Skills</th>
                    <th>Languages</th>
                    <th>Candidate ID</th>
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
                let profile = data[i];

                var row = document.createElement("tr");

                row.innerHTML += "<td style='text-align: center'>" + data[i]["PROFILE_ID"] + "</td>";
                row.innerHTML += "<td>" + data[i]["EDUCATION"] + "</td>";
                row.innerHTML += "<td>" + data[i]["EXPERIENCE"] + "</td>";
                row.innerHTML += "<td>" + data[i]["SKILLS"] + "</td>";
                row.innerHTML += "<td>" + data[i]["LANGUAGES"] + "</td>";
                row.innerHTML += "<td style='text-align: center'>" + data[i]["CANDIDATE_ID"] + "</td>";

                $("#datatable tbody").append(row);
            }
        }

        function AJAX_get_candidate_profiles(filter){
            if(filter == ""){
                $.ajax({
                    "url": API_URL + "get_candidate_profiles",
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
                    "url": API_URL + "get_candidate_profiles?" + filter,
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
            AJAX_get_candidate_profiles("");
        }

        function search_filter(){
            var filterType = $("#filter-type").val();
            var filterValue = $("#searchbar").val();

            var filter = filterType + "=" + filterValue;
            
            AJAX_get_candidate_profiles(filter);
        }
    </script>
<?php $this->endSection() ?>