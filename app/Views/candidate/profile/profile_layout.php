<?php $this->extend("layout") ?>

<?php $this->section("title") ?>
    <title>Job Hunt - Profile</title>
<?php $this->endSection() ?>

<?php $this->section("content") ?>
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>   
    <link rel="stylesheet" href="<?= base_url("css/candidate/profile.css") ?>">
    <script src="<?= base_url("js/candidate/profile.js") ?>"></script>

    <div class="profile-container">
        <div class="profile-header">
            <a href="<?= base_url("candidate/profile") ?>" class="<?= ($tab == "overview") ? "selected" : "" ?>" style="display: flex; align-items:center">
                <ion-icon name="book-outline" style="margin-right: 10px"></ion-icon>Overview
            </a>
            <a href="<?= base_url("candidate/profile?tab=education") ?>" class="<?= ($tab == "education") ? "selected" : "" ?>" style="display: flex; align-items:center">
                <ion-icon name="school-outline" style="margin-right: 10px"></ion-icon>Education
            </a>
            <a href="<?= base_url("candidate/profile?tab=experience") ?>" class="<?= ($tab == "experience") ? "selected" : "" ?>" style="display: flex; align-items:center">
                <ion-icon name="briefcase-outline" style="margin-right: 10px"></ion-icon>Experience
            </a>
            <a href="<?= base_url("candidate/profile?tab=skills") ?>" class="<?= ($tab == "skills") ? "selected" : "" ?>" style="display: flex; align-items:center">
                <ion-icon name="build-outline" style="margin-right: 10px"></ion-icon>Skills
            </a>
            <a href="<?= base_url("candidate/profile?tab=language") ?>" class="<?= ($tab == "language") ? "selected" : "" ?>" style="display: flex; align-items:center">
                <ion-icon name="language-outline" style="margin-right: 5px"></ion-icon>Language
            </a>
        </div>
        <div class="profile-body">
            <div class="profile-bio">
                <?php if(is_null($profile) || is_null($profile["PHOTO"])): ?>
                    <img src='<?= base_url("assets/blank_profile.png") ?>' width="200px" height="200px" style="border-radius: 50%"><br>
                <?php else: ?>
                    <img src='data:image/*;base64,<?= base64_encode($profile["PHOTO"]) ?>' width="200px" height="200px" style="border-radius: 50%"><br>
                <?php endif ?>

                <div style="margin-top: 30px; font-size: 1.4em;">
                    <b><?= session()->get("currentUser")["FIRST_NAME"] ?> <?= session()->get("currentUser")["LAST_NAME"] ?></b>
                </div>

                <div style="margin-top: 15px; font-size: 0.8em;">
                    <?php if(!is_null($profile) && !is_null($profile["AGE"])): ?>
                        21 Years Old<br>
                    <?php endif ?>
                    <?php if(!is_null($profile) && !is_null($profile["GENDER"])): ?>
                        Male
                    <?php endif ?>
                </div>

                <table class="contact-box">
                    <tr>
                        <td class="icon-col"><i class="fa-regular fa-envelope" style="margin-right: 15px"></i></td>
                        <td><?= session()->get("currentUser")["EMAIL"] ?></td>
                    </tr>
                    <tr>
                        <td class="icon-col"><i class="fa-solid fa-phone" style="margin-right: 15px"></i></td>
                        <?php if(is_null($profile) || is_null($profile["PHONE"])): ?>
                            <td>-</td>
                        <?php else: ?>
                            <td>(60+) 169519266</td>
                        <?php endif ?>
                    </tr>
                    <tr>
                        <td class="icon-col"><i class="fa-solid fa-location-dot" style="margin-right: 15px"></i></td>
                        <?php if(is_null($profile) || is_null($profile["ADDRESS"])): ?>
                            <td>-</td>
                        <?php else: ?>
                            <td>Malaysia</td>
                        <?php endif ?>
                    </tr>
                </table>
            </div>
            <div class="profile-detail">
                <?php $this->renderSection("profile-detail") ?>
            </div>
        </div>
    </div>
<?php $this->endSection() ?>