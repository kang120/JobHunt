<?php $this->extend("layout") ?>

<?php $this->section("title") ?>
    <title>Job Hunt - inquiry</title>
<?php $this->endSection() ?>

<?php $this->section("content") ?>
    <link rel="stylesheet" href="<?= base_url("css/candidate/application.css") ?>">
    <script src="<?= base_url("js/inquiry.js") ?>"></script>

    <div id="container" class="container">
        <div class="title-row">
            <div style="font-size: 2em"><b>Your application</b></div>
        </div>

        <table width="100%" style="margin-top: 20px">
            <col width="5%">
            <col width="35%">
            <col width="35%">
            <col width="10%">
            <col width="10%">
            <thead>
                <th>Index</th>
                <th>Job Title</th>
                <th>Company</th>
                <th>Result</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php foreach($applications as $key => $application): ?>
                    <tr>
                        <td style="text-align: center"><?= $key+1 ?></td>
                        <td><?= $application["JOB_TITLE"] ?></td>
                        <td><?= $application["COMPANY_NAME"] ?></td>
                        <td style="text-align: center">
                            <?php if(strtolower($application["RESULT"]) == "pending"): ?>
                                <div style="color: #ff9d00"><b>Pending</b></div>
                            <?php elseif(strtolower($application["RESULT"]) == "success"): ?>
                                <div style="color: #19e087"><b>Success</b></div>
                            <?php else: ?>
                                <div style="color: red"><b>Rejected</b></div>
                            <?php endif ?>
                        </td>
                        <td style="text-align: center">
                            <div style="display: flex; text-align: center">
                                <a href="<?= base_url("job/details?job_id=" . $application["JOB_ID"]) ?>"><button class="btn btn-success">View</button></a>
                                <form id="delete-form" method="POST">
                                    <input name="application_id" type="text" value="<?= $application["APPLICATION_ID"] ?>" hidden>
                                    <button class="btn btn-danger" type="button" style="margin-left: 15px" onclick="deletebtn_onclick()">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

    <script>
        function deletebtn_onclick(){
            if(confirm("Are you sure to delete application?")){
                $("#delete-form").submit();
            }
        }
    </script>
<?php $this->endSection() ?>