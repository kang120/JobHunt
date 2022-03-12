<?php $this->extend("candidate/profile/profile_layout") ?>

<?php $this->section("profile-detail") ?>
    <div style="display: flex;"><div id="add-btn" class="add-btn <?= isset($validation) ? "hide" : "show" ?>" onclick="showAddEducationForm()">Add</div></div>

    <form id="add-profile-form" class="add-profile-form <?= isset($validation) ? "show" : "hide" ?>" action="<?= base_url("/candidate/profile/education") ?>" method="POST">
        <div class="row">
            <div class="col-25">
                <label>Institute/University</label>
            </div>
            <div class="col-75">
                <input class="form-input" name="university_name" type="text">
            </div>
        </div>
        <div class="error-msg"><?= isset($validation) ? $validation->getError("university_name") : "" ?></div>
        <div class="row">
            <div class="col-25">
                <label>Graduation Date</label>
            </div>
            <div class="col-75">
                <input class="form-input" name="graduation_month" style="width: 30%;" type="number" min="1" max="12" placeholder="Month">
                <input class="form-input" name="graduation_year" style="margin-left: 15px; width: 30%;" type="number" min="1962" max="2030" placeholder="Year">
            </div>
        </div>
        <div class="col-75" style="display: flex; margin-left: 30%">
            <div class="error-msg" style="margin-left: 0; width: 30%"><?= isset($validation) ? $validation->getError("graduation_month") : "" ?></div>
            <div class="error-msg" style="margin-left: 15px; width: 30%"><?= isset($validation) ? $validation->getError("graduation_year") : "" ?></div>
        </div>
        <div class="row">
            <div class="col-25">
                <label>Course</label>
            </div>
            <div class="col-75">
                <input class="form-input" name="course" type="text">
            </div>
        </div>
        <div class="error-msg"><?= isset($validation) ? $validation->getError("course") : "" ?></div>
        <div class="row">
            <div class="col-25">
                <label>Institute/University Location</label>
            </div>
            <div class="col-75">
                <input class="form-input" name="university_location" type="text">
            </div>
        </div>
        <div class="error-msg"><?= isset($validation) ? $validation->getError("university_location") : "" ?></div>
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
    <?php else: ?>
        <?php $index = 0 ?>
        <?php foreach($educations as $education): ?>
            <div style="margin-top: 50px">
                <div class="row-1">
                    <div class="col-20">
                        <?= $education["graduationDate"] ?>
                    </div>
                    <div class="col-80" style="font-size: 1.5em">
                        <b><?= $education["universityName"] ?></b>
                    </div>
                    <form method="POST" action="<?= base_url("candidate/profile/education/delete") ?>" id="delete-btn-<?= $index ?>" class="delete-btn">
                        <input name="index" value="<?= $index ?>" hidden>
                        <div onclick="deleteEducation(<?= $index ?>)">Delete</div>
                    </form>
                </div>
                <div class="row-2" style="margin-top: 5px">
                    <div class="col-20"></div>
                    <div class="col-80">
                        <?= $education["course"] ?>, <?= $education["universityLocation"] ?>
                    </div>
                </div>
            </div>
            <?php $index += 1 ?>
        <?php endforeach ?>
    <?php endif ?>
<?php $this->endSection() ?>