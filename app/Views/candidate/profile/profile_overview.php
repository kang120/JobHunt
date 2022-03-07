<?php $this->extend("candidate/profile/profile_layout") ?>

<?php $this->section("profile-detail") ?>
    <?php if(is_null($profile)): ?>
        <div style="width: fit-content; margin: auto; text-align: center; margin-top: 100px">
            <img src="<?= base_url("assets/edit_profile.png") ?>" width="200px" height="200px">
            <div style="font-size: 1.5em; margin-top: 30px;">You haven't set up your profile</div>
            <button class="btn setup-btn" style="margin-top: 20px; width: 250px" onclick="first_setup_profile()">Set up now</button>
        </div>
    <?php endif ?>
<?php $this->endSection() ?>