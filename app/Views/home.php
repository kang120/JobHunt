<?php $this->extend("layout") ?>

<?php $this->section("title") ?>
    <title>Job Hunt</title>
<?php $this->endSection() ?>

<?php $this->section("content") ?>
    <link rel="stylesheet" href=<?= base_url("css/home.css") ?>>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <main>
        <!-- <h1 style="font-size: 10.0em;">Job Hunt</h1> -->
        <img src="<?= base_url("assets/logo.png") ?>" width="900px">
        <div class="search-container">
            <div class="search-form">
                <h1 style="margin-bottom: 15px">Find Your Jobs</h1>
                <div style="height: 40px;">
                    <form method="GET" action="<?= base_url("search_job") ?>">
                        <div style="position: relative">
                            <input id="searchbar" class="searchbar" name="title" type="text" placeholder="Job Title" autocomplete="off">
                            <!-- <ion-icon name="locate-outline" class="input-icon"></ion-icon> -->
                            <i class="fa-solid fa-magnifying-glass search-icon"></i>
                            <input class="search-btn" type="submit" value="Search">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        function search_onclick(){
            var value = document.getElementById("searchbar").value;
            console.log(value);
        }
    </script>
<?php $this->endSection() ?>