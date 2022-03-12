<html>
    <head>
        <?php $this->renderSection("title") ?>
        <link rel="stylesheet" href=<?= base_url("css/main.css") ?>>
        <link rel="stylesheet" href=<?= base_url("css/button.css") ?>>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="<?= base_url('js/layout.js') ?>"></script>
    </head>

    <body>
        <div class="header">
            <div class="navbar">
                <img class="logo" src="<?= base_url("assets/logo.png") ?>">
                <div class="nav nav-left">
                    <a class="nav-item" href="<?= base_url("") ?>">Home</a>
                    <a class="nav-item" href="<?= base_url("search_job") ?>">Search Jobs</a>
                    <?php if(!is_null($currentUser)): ?>
                        <a class="nav-item" href="<?= base_url("candidate/job/application") ?>">My Application</a>
                        <a class="nav-item" href="<?= base_url("candidate/inquiry") ?>">Inquiry</a>
                    <?php endif ?>
                </div>
                <div class="nav nav-right">
                    <?php if(is_null($currentUser)): ?>
                        <a class="nav-item" href="<?= base_url("candidate/login") ?>">Login</a>
                        <a class="nav-item" href="<?= base_url("candidate/signup") ?>">Sign up</a>
                        <a class="employer-nav" href="">I'm Employer</a>
                    <?php else: ?>
                        <div id="profile-nav" class="profile-nav">
                            <div style="margin-right: 15px"><?= session()->get("currentUser")["FIRST_NAME"] ?></div>
                            <img id="profile-nav-img" src="<?= base_url("assets/blank_profile.png") ?>" width="30px" height ="30px" style="border-radius: 50%;">
                            <div id="angle-down" style="padding-left: 10px;"><i class="fa-solid fa-angle-down fa-xs"></i></div>
                        </div>
                    <?php endif ?>
                </div>
            </div>

            <div id="user-dropdown">
                <hr>
                <div class="dropdown-box" onclick="view_profile()">Profile</div>
                <hr>
                <div class="dropdown-box" onclick="signout()">Sign out</div>
            </div>
        </div>
        <?php $this->renderSection("content") ?>
    </body>
</html>