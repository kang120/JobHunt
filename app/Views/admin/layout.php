<html>

    <head>
        <?php $this->renderSection("title") ?>
        <link rel="stylesheet" href="<?= base_url("css/admin/layout.css") ?>">
        <link rel="stylesheet" href="<?= base_url("css/button.css") ?>">
        
        <script src="<?= base_url("js/admin/main.js") ?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>

    <body>
        <main>
            <div class="nav-menu">
                <div class="admin-box">
                    <div style="font-size: 1.5em">JMS System</div>
                    <div style="margin-top: 15px">Welcome, <?= $currentAdmin["NAME"] ?></div>
                    <div style="margin-top: 20px;"><button class="btn btn-gray" onclick="sign_out()">Sign out</button></div>
                </div>
                <div class="nav-option">
                    <a class="nav-button <?= ($page == "dashboard") ? "selected" : "" ?>" href="<?= base_url("admin/dashboard") ?>">
                        Dashboard
                    </a>
                    <a class="nav-button <?= ($page == "candidate") ? "selected" : "" ?>" href="<?= base_url("admin/candidate") ?>">
                        Candidate
                    </a>
                    <a class="nav-button <?= ($page == "candidateProfile") ? "selected" : "" ?>" href="<?= base_url("admin/candidate_profile") ?>">
                        Candidate Profile
                    </a>
                    <a class="nav-button <?= ($page == "employer") ? "selected" : "" ?>" href="<?= base_url("admin/employer") ?>">
                        Employer
                    </a>
                    <a class="nav-button <?= ($page == "company") ? "selected" : "" ?>" href="<?= base_url("admin/company") ?>">
                        Company
                    </a>
                    <a class="nav-button <?= ($page == "job") ? "selected" : "" ?>" href="<?= base_url("admin/job") ?>">
                        Job
                    </a>
                    <a class="nav-button <?= ($page == "jobApplication") ? "selected" : "" ?>" href="<?= base_url("admin/job_application") ?>">
                        Job Application
                    </a>
                    <a class="nav-button <?= ($page == "candidateInquiry") ? "selected" : "" ?>" href="<?= base_url("admin/candidate_inquiry") ?>">
                        Candidate Inquiry
                    </a>
                    <a class="nav-button <?= ($page == "employerInquiry") ? "selected" : "" ?>" href="<?= base_url("admin/employer_inquiry") ?>">
                        Employer Inquiry
                    </a>
                    <a class="nav-button <?= ($page == "admin") ? "selected" : "" ?>" href="<?= base_url("admin/user") ?>">
                        Admin
                    </a>
                </div>
            </div>

            <div class="content">
                <?php $this->renderSection("content") ?>
            </div>
        </main>
    </body>

</html>