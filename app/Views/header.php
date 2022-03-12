<html>
    <head>
        <?php $this->renderSection("title") ?>
        <link rel="stylesheet" href=<?= base_url("css/main.css") ?>>
    </head>

    <body>
        <div class="header">
            <div class="navbar">

                <div class="nav nav-left">
                    <?php if("http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] == base_url("home2")): ?>
                        <a class="nav-item" href="<?= base_url("/") ?>">Home</a>
                    <?php else: ?>
                        <a class="nav-item" href="<?= base_url("home2") ?>">Home</a>
                    <?php endif ?>
                    <a class="nav-item" href="<?= base_url("search_job") ?>">Search Jobs</a>
                </div>
                <div class="nav nav-right">
                    <a class="nav-item" href="">Login</a>
                    <a class="nav-item" href="<?= base_url("candidate/signup") ?>">Sign up</a>
                    <a class="nav-item" href="<?= base_url("employer/testing") ?>">test it</a>
                    <a class="employer-nav" href="">I'm Employer</a>
                </div>
            </div>
        </div>
        <?php $this->renderSection("content") ?>
    </body>
</html>