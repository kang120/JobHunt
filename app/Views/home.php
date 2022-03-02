<?php $this->extend("layout") ?>

<?php $this->section("title") ?>
    <title>Job Hunt</title>
<?php $this->endSection() ?>

<?php $this->section("content") ?>
    <link rel="stylesheet" href=<?= base_url("css/home.css") ?>>
    
    <main>
        <div class="search-container">
            <div class="search-form">
                <h1 style="margin-bottom: 15px">Find Your Jobs</h1>
                <div style="height: 40px;">
                    <input class="searchbar" type="text" placeholder="Job Title">
                    <!-- <ion-icon name="locate-outline" class="input-icon"></ion-icon> -->
                    <button class="search-btn">Search</button>
                </div>
            </div>
        </div>
        <div class="home-body">
            <div class="intro-container">
                
            </div>
        </div>
    </main>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<?php $this->endSection() ?>