<?php $this->extend("layout") ?>

<?php $this->section("title") ?>
    <title>Job Hunt</title>
<?php $this->endSection() ?>

<?php $this->section("content") ?>
    <link rel="stylesheet" href=<?= base_url("css/button.css") ?>>
    <link rel="stylesheet" href=<?= base_url("css/candidate/setup_profile.css") ?>>

    <main>
        <div style="text-align: center; margin-top: 70px;">
            <div class="success-notice">You have successfully create an account</div>
            <div class="container">
                <img src="<?= base_url("assets/blank_profile.png") ?>" width="150px" height="150px" style="border-radius: 50%"><br>
                <div style="margin-top: 40px; font-size: 2em">Set up your profile to let employers know more about you</div>
                <form method="GET" action="<?= base_url('candidate/profile') ?>" class="option-box">
                    <a class="skip-btn" href="<?= base_url() ?>">Skip</a>
                    <button class="btn setup-btn">Setup now</button>
                </form>
            </div>
        </div>
    </main>

<?php $this->endSection() ?>