<?php $this->extend("candidate/profile/profile_layout") ?>

<?php $this->section("profile-detail") ?>
    <link rel="stylesheet" href="<?= base_url("css/candidate/profile_education.css") ?>">

    <div style="display: flex;"><div id="add-btn" class="add-btn <?= isset($validation) ? "hide" : "show" ?>" onclick="showAddEducationForm()">Add</div></div>

    <form id="add-profile-form" class="add-profile-form <?= isset($validation) ? "show" : "hide" ?>" action="<?= base_url("/candidate/profile/education") ?>" method="POST">
        <table width="100%">
            <col width="25%">
            <col width="75%">
            <tr>
                <td><label>Institute/University</label></td>
                <td style="padding-left: 25px">
                    <input class="form-input" name="university_name" type="text">
                </td>
            </tr>
            <tr>
                <td><label>Graduation Date</label></td>
                <td style="padding-left: 25px">
                    <input class="form-input" name="graduation_month" style="width: 30%;" type="number" min="1" max="12" placeholder="Month">
                    <input class="form-input" name="graduation_year" style="margin-left: 15px;width: 30%;" type="number" min="1962" max="2030" placeholder="Year">
                </td>
            </tr>
            <tr>
                <td><label>Course</label></td>
                <td style="padding-left: 25px"><input class="form-input" name="course" type="text"></td>
            </tr>
            <tr>
                <td><label>Institute/University Location</label></td>
                <td style="padding-left: 25px"><input class="form-input" name="university_location" type="text"></td>
            </tr>
        </table>
        <div class="form-btn-box">
            <input class="btn btn-success" type="submit" value="Save">
            <input class="btn btn-primary" style="margin-left: 10px" type="button" value="Cancel" onclick="closeAddProfileForm()">
        </div>
    </form>

    <?php if(is_null($profile) || is_null($profile["EDUCATION"])): ?>
        <div style="width: fit-content; margin: auto; text-align: center; margin-top: 100px">
            <ion-icon name="school-outline" style="font-size: 200px"></ion-icon>
            <!-- <img src="<?= base_url("assets/edit_profile.png") ?>" width="200px" height="200px"> -->
            <div style="font-size: 1.5em; margin-top: 30px;">Your education is empty</div>
        </div>
    <?php endif ?>
<?php $this->endSection() ?>