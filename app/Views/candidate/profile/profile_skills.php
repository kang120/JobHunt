<?php $this->extend("candidate/profile/profile_layout") ?>

<?php $this->section("profile-detail") ?>
    <div style="display: flex;"><div id="add-btn" class="add-btn <?= isset($validation) ? "hide" : "show" ?>" onclick="showAddEducationForm()">Add</div></div>

    <form id="add-profile-form" class="add-profile-form add-education-form <?= isset($validation) ? "show" : "hide" ?>" action="<?= base_url("/candidate/profile/skills") ?>" method="POST">
        <div class="row">
            <div class="col-25">
                <label>Skill</label>
            </div>
            <div class="col-75">
                <input class="form-input" name="skill_name" type="text">
            </div>
        </div>
        <div class="error-msg"><?= isset($validation) ? $validation->getError("skill_name") : "" ?></div>
        <div class="row">
            <div class="col-25">
                <label>Proficiency (1-10)</label>
            </div>
            <div class="col-75">
                <input class="form-input" name="proficiency" type="text">
            </div>
        </div>
        <div class="error-msg"><?= isset($validation) ? $validation->getError("proficiency") : "" ?></div>

        <div class="form-btn-box">
            <input class="btn btn-success" type="submit" value="Save">
            <input class="btn btn-primary" style="margin-left: 10px" type="button" value="Cancel" onclick="closeAddProfileForm()">
        </div>
    </form>

    <?php if(is_null($profile) || is_null($profile["SKILLS"])): ?>
        <div style="width: fit-content; margin: auto; text-align: center; margin-top: 100px">
            <ion-icon name="build-outline" style="font-size: 200px"></ion-icon>
            <!-- <img src="<?= base_url("assets/edit_profile.png") ?>" width="200px" height="200px"> -->
            <div style="font-size: 1.5em; margin-top: 30px;">Your skill is empty</div>
        </div>
    <?php else: ?>
        <div class="row-1" style="margin-top: 50px; margin-bottom: 10px">
            <div class="col-20">
                <b>Skill</b>
            </div>
            <div class="col-80">
                <b>Proficiency (1-10)</b>
            </div>
        </div>
        <hr style="margin-bottom: 15px">
        <?php $index = 0 ?>
        <?php foreach($skills as $skill): ?>
            <div style="margin-top: 10px">
                <div class="row-2">
                    <div class="col-20">
                        <?= $skill["skillName"] ?>
                    </div>
                    <div class="col-80">
                        <?= $skill["proficiency"] ?>
                    </div>
                    <form method="POST" action="<?= base_url("candidate/profile/skill/delete") ?>" id="delete-btn-<?= $index ?>" class="delete-btn">
                        <input name="index" value="<?= $index ?>" hidden>
                        <div onclick="deleteSkill(<?= $index ?>)">Delete</div>
                    </form>
                </div>
            </div>
            <?php $index += 1 ?>
        <?php endforeach ?>
    <?php endif ?>
<?php $this->endSection() ?>