<?php $this->extend("layout") ?>

<?php $this->section("title") ?>
    <title>Job Hunt - search job</title>
<?php $this->endSection() ?>

<?php $this->section("content") ?>
    <link rel="stylesheet" href=<?= base_url("css/search_job.css") ?>>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <main>
        <div class="search-container">
            <div class="search-form">
                <div style="height: 40px; position: relative">
                    <input class="searchbar" type="text" placeholder="Job Title">
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    <!-- <ion-icon name="locate-outline" class="input-icon"></ion-icon> -->
                    <button class="search-btn">Search</button>
                    <button class="filter-btn">Filter</button>
                </div>
            </div>
        </div>

        <div class="search-body">
            <div class="search-result-container">
                <?php foreach($jobs as $job): ?>
                    <div class="job-container">
                        <div style="width: 300px; height: 200px">
                            <img src="<?= $job["PHOTO"] ?>" style="width: 100%; height: 100%;">
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
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </main>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<?php $this->endSection() ?>