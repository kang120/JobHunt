<?php $this->extend("employer/layout") ?>

<?php $this->section("title") ?>
    <title>Job Hunt - Job</title>
<?php $this->endSection() ?>

<?php $this->section("content") ?>
    <link rel="stylesheet" href="<?= base_url('css/job_details.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/employer/view_job.css') ?>">

    <script src="<?= base_url("js/employer/view_job.js") ?>"></script>

    <div id="job-container" class="job-container">
        <div class="job-header">
            <img class="company-image" src='data:image/*;base64,<?= base64_encode($company["PHOTO"]) ?>' width="200px" height="200px" style="border-radius: 50%">
            <div class="job-title-box">
                <div style="display: flex; align-items: center">
                    <div style="font-size: 2em;"><b><?= $job["TITLE"] ?></b></div>
                    <?php if(strtolower($job["TYPE"]) == "fulltime"): ?>
                        <div class="jobtype-label fulltime-label">Full Time</div>
                    <?php elseif(strtolower($job["TYPE"]) == "parttime"): ?>
                        <div class="jobtype-label parttime-label">Part Time</div>
                    <?php else: ?>
                        <div class="jobtype-label internship-label">Internship</div>
                    <?php endif ?>
                </div>
                <div style="font-size: 1.3em; margin-top: 10px"><?= $company["NAME"] ?></div>
                <div style="display: flex; align-items: center; margin-top: 20px; margin-bottom: 10px;">
                    <i class="fa-solid fa-location-dot fa-lg"></i><div style="margin-left: 10px; font-size: 1.3em;"><?= $company["LOCATION"] ?></div>
                </div>
                <div style="display: flex; align-items: center;">
                    <i class="fa-solid fa-money-bill-wave fa-lg"></i><p style="margin-left: 10px; font-size: 1.0em;"><?= $job["SALARY"] ?></p>
                </div>
            </div>

            <div class="right-box">
                <button class="btn btn-primary" style="margin-bottom: 15px; font-size: 1.1em" onclick="showApplicantModal()">View Applicants</button>
            </div>
        </div>

        <div class="job-body">
            <div class="job-description">
                <div><b style="font-size: 1.5em">Job Description</b></div>
                <div style="margin-top: 30px; text-align: justify; font-size: 1.2em;"><?= $job["DESCRIPTION"] ?></div>
            </div>
            <div class="job-scope" style="margin-top: 70px">
                <div><b style="font-size: 1.5em">Job Scope</b></div>
                <div style="margin-top: 30px;">
                    <?php foreach($job["SCOPE"] as $scope): ?>
                        <li style="text-align: justify; font-size: 1.3em; margin-top: 10px"><?= $scope ?></li>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="job-requirement" style="margin-top: 70px">
                <div><b style="font-size: 1.5em">Job Requirement</b></div>
                <div style="margin-top: 30px;">
                    <?php foreach($job["REQUIREMENT"] as $requirement): ?>
                        <li style="text-align: justify; font-size: 1.3em; margin-top: 10px"><?= $requirement ?></li>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="job-information" style="margin-top: 70px">
                <div><b style="font-size: 1.5em">Job Information</b></div>
                <div style="margin-top: 30px;">
                    <div style="font-size: 1.2em"><b>Specialization</b></div>
                    <div style="margin-top: 10px; font-size: 1.1em;"><?= $job["SPECIALIZATION"] ?></div>
                    <div style="font-size: 1.2em; margin-top: 20px"><b>Qualification</b></div>
                    <div style="margin-top: 10px; font-size: 1.1em;"><?= $job["QUALIFICATION"] ?></div>
                    <div style="font-size: 1.2em; margin-top: 20px"><b>Career Level</b></div>
                    <div style="margin-top: 10px; font-size: 1.1em;"><?= $job["CAREER_LEVEL"] ?></div>
                </div>
            </div>
        </div>
    </div>

    <!--  Applicants Modal  -->
    <div id="applicant-modal">
        <div style="font-size: 2em; text-align: center"><b>Applicants</b></div>
        <div style="margin-top: 50px">
            <?php if(empty($applicants)): ?>
                <div style="text-align: center; font-size: 2em; margin-top: 250px">This job is currently not applied by anyone</div>
            <?php else: ?>
                <div class="applicant-container">
                    <table style="width: 100%">
                        <col width="55%">
                        <col width="45%">
                        <thead>
                            <th>Name</th>
                            <th>Response</th>
                        </thead>
                        <tbody>
                            <?php $index = 1 ?>
                            <?php foreach($applicants as $applicant): ?>
                                <tr>
                                    <td><?= $applicant["FIRST_NAME"] ?> <?= $applicant["LAST_NAME"] ?></td>
                                    <td>
                                        <div>
                                            <input id="status-<?= $index ?>" name="status" type="text" value="<?= $applicant["STATUS"] ?>" hidden>
                                            <button class="btn status-btn <?= ($applicant["STATUS"] == "Success") ? "btn-success" : "btn-gray" ?>" onclick="acceptApplicant(<?= $index ?>)">Accept</button>
                                            <button class="btn status-btn <?= ($applicant["STATUS"] == "Pending") ? "btn-primary" : "btn-gray" ?>" style="margin-left: 5px" onclick="pendingApplicant(<?= $index ?>)">Pending</button>
                                            <button class="btn status-btn <?= ($applicant["STATUS"] == "Rejected") ? "btn-danger" : "btn-gray" ?>" style="margin-left: 5px" onclick="rejectApplicant(<?= $index ?>)">Reject</button>
                                        </div>
                                    </td>
                                </tr>
                                <?php $index += 1 ?>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    
                </div>
            <?php endif ?>
        </div>
        
        <div style="position: absolute; bottom: 15px; left: 50%; transform: translateX(-50%)">
            <button class="btn btn-success" onclick="saveApplicationResult()">Save</button>
            <button class="btn btn-primary" style="margin-left: 15px" onclick="closeApplicantModal()">Close</button>
        </div>

        <form method="POST" id="status-form" style="display: none">
            <input id="application_status" name="application_status" type="text" hidden>
        </form>
    </div>
<?php $this->endSection() ?>