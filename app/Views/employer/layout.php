<html>
    <head>
        <?php

use App\Models\ProfileModel;

 $this->renderSection("title") ?>
        <link rel="stylesheet" href=<?= base_url("css/main.css") ?>>
        <link rel="stylesheet" href=<?= base_url("css/button.css") ?>>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
        <script src="<?= base_url('js/employer/main.js') ?>"></script>
    </head>

    <body>
        <div class="header">
            <div class="navbar">
                <img class="logo" src="<?= base_url("assets/logo.png") ?>">
                <div class="nav nav-left">
                    <?php if(!is_null($currentEmployer)): ?>
                        <a class="nav-item" href="<?= base_url("employer/company/list") ?>">My Company</a>
                        <a class="nav-item" href="<?= base_url("employer/inquiry") ?>">Inquiry</a>
                    <?php endif ?>
                </div>
                <div class="nav nav-right">
                    <?php if(is_null($currentEmployer)): ?>
                        <a class="nav-item" href="<?= base_url("employer/login") ?>">Login</a>
                        <a class="nav-item" href="<?= base_url("employer/signup") ?>">Sign up</a>
                        <a class="candidate-nav" href="<?= base_url("home") ?>">I'm Candidate</a>
                    <?php else: ?>
                        <div id="profile-nav" class="profile-nav">
                            <div style="margin-right: 15px"><?= $currentEmployer["FIRST_NAME"] ?></div>
                            <div id="angle-down" style="padding-left: 10px;"><i class="fa-solid fa-angle-down fa-xs"></i></div>
                        </div>
                    <?php endif ?>
                </div>
            </div>

            <div id="user-dropdown">
                <hr>
                <div class="dropdown-box" onclick="signout()">Sign out</div>
            </div>
            <hr>
        </div>
        <?php $this->renderSection("content") ?>
    </body>
</html>