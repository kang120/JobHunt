<?php $this->extend("layout") ?>

<?php $this->section("title") ?>
    <title>Job Hunt - search job</title>
<?php $this->endSection() ?>

<?php $this->section("content") ?>
    <link rel="stylesheet" href=<?= base_url("css/search_job.css") ?>>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script src="<?= base_url("js/search_job.js") ?>"></script>

    <main>
        <div style="text-align: center; font-size: 2.5em; margin-top: 30px; margin-bottom: 20px">
            <b>Search Job</b>
        </div>

        <div class="search-container">
            <div class="search-form">
                <form method="GET" style="height: 40px; position: relative">
                    <input class="searchbar" name="title" type="text" placeholder="Job Title" value="<?= is_null($title) ? "" : $title ?>" autocomplete="off">
                    <?php if(!is_null($location)): ?>
                        <input name="location" type="text" value="<?= $location ?>" hidden>
                    <?php endif ?>
                    <?php if(!is_null($jobtype)): ?>
                        <input name="jobtype" type="text" value="<?= $jobtype ?>" hidden>
                    <?php endif ?>
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    <!-- <ion-icon name="locate-outline" class="input-icon"></ion-icon> -->
                    <button class="search-btn">Search</button>
                </form>
            </div>
        </div>

        <div class="search-body">
            <div class="search-result-container">
                <!--
                <?php if(!is_null($title)): ?>
                    <div style="font-size: 1.5em; margin-bottom: 30px">
                        <b>Search Result: <?= $title ?></b>
                    </div>
                <?php endif ?>
                -->
                <?php if(!is_null($title) || !is_null($location) || !is_null($jobtype)): ?>
                    <div class="query-row">
                        <?php if(!is_null($title)): ?>
                            <form method="GET" class="query-box" onclick="this.submit()">
                                <i class="fa-regular fa-circle-xmark"></i><b style="margin-left: 10px">Keyword:</b> &nbsp;<?= $title ?>
                                <?php if(!is_null($location)): ?>
                                    <input name="location" type="text" value="<?= $location ?>" hidden>
                                <?php endif ?>
                                <?php if(!is_null($jobtype)): ?>
                                    <input name="jobtype" type="text" value="<?= $jobtype ?>" hidden>
                                <?php endif ?>
                            </form>
                        <?php endif ?>
                        <?php if(!is_null($location)): ?>
                            <form method="GET" class="query-box" onclick="this.submit()">
                                <i class="fa-regular fa-circle-xmark"></i><b style="margin-left: 10px">Location:</b> &nbsp;<?= $location ?>
                                <?php if(!is_null($title)): ?>
                                    <input name="title" type="text" value="<?= $title ?>" hidden>
                                <?php endif ?>
                                <?php if(!is_null($jobtype)): ?>
                                    <input name="jobtype" type="text" value="<?= $jobtype ?>" hidden>
                                <?php endif ?>
                            </form>
                        <?php endif ?>
                        <?php if(!is_null($jobtype)): ?>
                            <form method="GET" class="query-box" onclick="this.submit()">
                            <i class="fa-regular fa-circle-xmark"></i><b style="margin-left: 10px">Jobtype:</b> &nbsp;<?= $jobtype ?>
                                <?php if(!is_null($title)): ?>
                                    <input name="title" type="text" value="<?= $title ?>" hidden>
                                <?php endif ?>
                                <?php if(!is_null($location)): ?>
                                    <input name="location" type="text" value="<?= $location ?>" hidden>
                                <?php endif ?>
                        </form>
                        <?php endif ?>
                        <form method="GET" class="clear-query-btn" onclick="this.submit()">Clear All</form>
                    </div>
                <?php endif ?>
                <div class="flex-box">
                    <div class="filter-box">
                        <div class="filter-detail">
                            <div style="font-size: 1.5em; color: gray; margin-bottom: 25px">Location</div>
                            <form method="GET">
                                <input name="location" type="text" style="width: 100%; height: 30px; padding: 15px; border: 1px solid #d4d4d4" placeholder="Search by Location" value=<?= $location ?>>
                                <?php if(!is_null($title)): ?>
                                    <input name="title" type="text" value="<?= $title ?>" hidden>
                                <?php endif ?>
                                <?php if(!is_null($jobtype)): ?>
                                    <input name="jobtype" type="text" value="<?= $jobtype ?>" hidden>
                                <?php endif ?>
                                <input type="submit" hidden>
                            </form>
                        </div>
                        <div class="filter-detail">
                            <div style="font-size: 1.5em; color: gray; margin-bottom: 25px">Job Type</div>
                            <form method="GET" id="jobtype-form">
                                <input id="jobtype" name="jobtype" type="text" hidden>
                                <div class="checkbox-row" onclick="jobtype_onclick(this)">
                                    <input class="jobtype-checkbox" type="checkbox" value="fulltime" <?= ($jobtype == "fulltime") ? "checked" : "" ?> onclick="return false"><label style="margin-left: 15px">Full Time</label>
                                </div>
                                <div class="checkbox-row" onclick="jobtype_onclick(this)">
                                    <input class="jobtype-checkbox" type="checkbox" value="parttime" <?= ($jobtype == "parttime") ? "checked" : "" ?> onclick="return false"><label style="margin-left: 15px">Part Time</label>
                                </div>
                                <div class="checkbox-row" onclick="jobtype_onclick(this)">
                                    <input class="jobtype-checkbox" type="checkbox" value="internship" <?= ($jobtype == "internship") ? "checked" : "" ?> onclick="return false"><label style="margin-left: 15px">Internship</label>
                                </div>
                                <?php if(!is_null($title)): ?>
                                    <input name="title" type="text" value="<?= $title ?>" hidden>
                                <?php endif ?>
                                <?php if(!is_null($location)): ?>
                                    <input name="location" type="text" value="<?= $location ?>" hidden>
                                <?php endif ?>
                            </form>
                        </div>
                    </div>
                    <div class="job-box">
                        <?php if(!empty($jobs)): ?>
                            <?php foreach($jobs as $job): ?>
                                <a class="job-container" href="<?= base_url('job/details?job_id=' . $job['JOB_ID']) ?>" ?>
                                    <div style="width: 25%; height: 200px">
                                        <img src="data:image;base64, <?= base64_encode($job["PHOTO"]) ?>" style="width: 100%; height: 100%;">
                                    </div>
                                    <div class="job-description">
                                        <h2><?= $job["TITLE"] ?></h2>
                                        <p style="color: gray; margin-top: 5px;"><?= $job["COMPANY_NAME"] ?></p><br>
                                        
                                        <div style="display: flex; align-items: center; margin-bottom: 20px;">
                                            <i class="fa-solid fa-location-dot fa-lg"></i><b style="margin-left: 10px; font-size: 1.3em;"><?= $job["LOCATION"] ?></b>
                                        </div>
                                        <div style="display: flex; align-items: center;">
                                            <i class="fa-solid fa-money-bill-wave fa-lg"></i><p style="margin-left: 10px; font-size: 1.0em;"><?= $job["SALARY"] ?></p>
                                        </div>
                                    </div>

                                    <?php if(strtolower($job["TYPE"]) == "full time"): ?>
                                        <div class="jobtype-label fulltime-label">Full Time</div>
                                    <?php elseif(strtolower($job["TYPE"]) == "part time"): ?>
                                        <div class="jobtype-label parttime-label">Part Time</div>
                                    <?php else: ?>
                                        <div class="jobtype-label internship-label">Internship</div>
                                    <?php endif ?>
                                </a>
                            <?php endforeach ?>
                        <?php else: ?>
                            <div style="font-size: 2.5em; text-align: center; margin-top: 50px">
                                No search result
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php $this->endSection() ?>