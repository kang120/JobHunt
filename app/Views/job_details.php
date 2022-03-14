<?php $this->extend("layout") ?>

<?php $this->section("title") ?>
    <title>Job Hunt - Job</title>
<?php $this->endSection() ?>

<?php $this->section("content") ?>
    <link rel="stylesheet" href="<?= base_url('css/job_details.css') ?>">

    <div class="job-container">
        <div class="job-header">
            <img class="company-image" src='data:image/*;base64,<?= base64_encode($job["PHOTO"]) ?>' width="200px" height="200px" style="border-radius: 50%">
            <div class="job-title-box">
                <div style="display: flex; align-items: center">
                    <div style="font-size: 2em;"><b><?= $job["TITLE"] ?></b></div>
                    <?php if(strtolower($job["TYPE"]) == "full time"): ?>
                        <div class="jobtype-label fulltime-label">Full Time</div>
                    <?php elseif(strtolower($job["TYPE"]) == "part time"): ?>
                        <div class="jobtype-label parttime-label">Part Time</div>
                    <?php else: ?>
                        <div class="jobtype-label internship-label">Internship</div>
                    <?php endif ?>
                </div>
                <div style="font-size: 1.3em; margin-top: 10px"><?= $job["COMPANY_NAME"] ?></div>
                <div style="display: flex; align-items: center; margin-top: 20px; margin-bottom: 10px;">
                    <i class="fa-solid fa-location-dot fa-lg"></i><div style="margin-left: 10px; font-size: 1.3em;"><?= $job["LOCATION"] ?></div>
                </div>
                <div style="display: flex; align-items: center;">
                    <i class="fa-solid fa-money-bill-wave fa-lg"></i><p style="margin-left: 10px; font-size: 1.0em;"><?= $job["SALARY"] ?></p>
                </div>
            </div>
            
            <div class="right-box">
                <?php if(!$hasApply): ?>
                    <form method="GET">
                        <input name="job_id" type="text" value="<?= $job["JOB_ID"] ?>" hidden>
                        <input name="status" type="text" value="apply" hidden>
                        <button class="btn btn-success" style="margin-bottom: 15px; font-size: 1.1em">Apply Now</button>
                    </form>
                <?php else: ?>
                    <button class="btn btn-gray" style="margin-bottom: 15px; font-size: 1.1em; cursor: default">Applied</button>
                <?php endif ?>
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
<?php $this->endSection() ?>