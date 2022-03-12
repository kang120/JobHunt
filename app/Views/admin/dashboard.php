<?php $this->extend("admin/layout") ?>

<?php $this->section("title") ?>
    <title>Dashboard</title>
<?php $this->endSection() ?>

<?php $this->section("content") ?>
    <div style="padding: 50px 50px 50px 50px; position: relative; height: 100%">
        <div class="page-title"><b>Dashboard</b></div>

        <div class="statistic-panel">
            <a class="no-style" href="<?= base_url("admin/candidate") ?>">
                <div class="statistic-box">
                    <div class="statistic-number">
                        <div id="candidate-count" style="font-size: 4em">-</div><br>
                        <div style="font-size: 2em">Candidates</div>
                    </div>
                </div>
            </a>
            <a class="no-style" href="<?= base_url("admin/company") ?>">
                <div class="statistic-box">
                    <div class="statistic-number">
                        <div id="company-count" style="font-size: 4em">-</div><br>
                        <div style="font-size: 2em">Companies</div>
                    </div>
                </div>
            </a>
            <a class="no-style" href="<?= base_url("admin/job") ?>">
                <div class="statistic-box">
                    <div class="statistic-number">
                        <div id="job-count" style="font-size: 4em">-</div><br>
                        <div style="font-size: 2em">Jobs</div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <script>
        window.onload = function(){
            // read number of candidate
            $.ajax({
                url: API_URL + "get_candidates",
                method: "GET",
                success: function(data){
                    var count = data.length;
                    $("#candidate-count").html(count);
                },
                error: function(){
                    console.log("Something error");
                }
            })

            // read number of company
            $.ajax({
                url: API_URL + "get_companies",
                method: "GET",
                success: function(data){
                    var count = data.length;
                    $("#company-count").html(count);
                },
                error: function(){
                    console.log("Something error");
                }
            })

            // read number of job
            $.ajax({
                url: API_URL + "get_jobs",
                method: "GET",
                success: function(data){
                    var count = data.length;
                    $("#job-count").html(count);
                },
                error: function(){
                    console.log("Something error");
                }
            })
        }
    </script>
<?php $this->endSection() ?>