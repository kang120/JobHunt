<?php $this->extend("candidate/profile/profile_layout") ?>

<?php $this->section("profile-detail") ?>
    <div style="display: flex;"><div id="add-btn" class="add-btn <?= isset($validation) ? "hide" : "show" ?>" onclick="showAddEducationForm()">Add</div></div>

    <form id="add-profile-form" class="add-profile-form <?= isset($validation) ? "show" : "hide" ?>" action="<?= base_url("/candidate/profile/language") ?>" method="POST">
        <div class="row">
            <div class="col-25">
                <label>Language</label>
            </div>
            <div class="col-75">
                <input class="form-input" name="language" type="text" value="<?= isset($validation) ? $language : "" ?>">
            </div>
        </div>
        <div class="error-msg"><?= isset($validation) ? $validation->getError("language") : "" ?></div>
        <div class="row">
            <div class="col-25">
                <label>Speaking (1-10)</label>
            </div>
            <div class="col-75">
                <input class="form-input" name="speaking" type="number" min="1" max="10" value="<?= isset($validation) ? $speaking : "" ?>">
            </div>
        </div>
        <div class="error-msg"><?= isset($validation) ? $validation->getError("speaking") : "" ?></div>
        <div class="row">
            <div class="col-25">
                <label>Writing (1-10)</label>
            </div>
            <div class="col-75">
                <input class="form-input" name="writing" type="number" min="1" max="10" value="<?= isset($validation) ? $writing : "" ?>">
            </div>
        </div>
        <div class="error-msg"><?= isset($validation) ? $validation->getError("writing") : "" ?></div>
        <div class="row">
            <div class="col-25">
                <label>Reading (1-10)</label>
            </div>
            <div class="col-75">
                <input class="form-input" name="reading" type="number" min="1" max="10" value="<?= isset($validation) ? $reading : "" ?>">
            </div>
        </div>
        <div class="error-msg"><?= isset($validation) ? $validation->getError("reading") : "" ?></div>

        <div class="form-btn-box">
            <input class="btn btn-success" type="submit" value="Save">
            <input class="btn btn-primary" style="margin-left: 10px" type="button" value="Cancel" onclick="closeAddProfileForm()">
        </div>
    </form>

    <?php if(is_null($profile) || is_null($profile["LANGUAGES"])): ?>
        <div style="width: fit-content; margin: auto; text-align: center; margin-top: 100px">
            <ion-icon name="language-outline" style="font-size: 200px"></ion-icon>
            <!-- <img src="<?= base_url("assets/edit_profile.png") ?>" width="200px" height="200px"> -->
            <div style="font-size: 1.5em; margin-top: 30px;">Your language is empty</div>
        </div>
    <?php else: ?>
        <div class="row-1" style="margin-top: 50px; margin-bottom: 10px">
            <div class="col-20">
                <b>Language</b>
            </div>
            <div class="col-20">
                <b>Speaking (1-10)</b>
            </div>
            <div class="col-20">
                <b>Writing (1-10)</b>
            </div>
            <div class="col-20">
                <b>Reading (1-10)</b>
            </div>
        </div>
        <hr style="margin-bottom: 15px">
        <?php $index = 0 ?>
        <?php foreach($languages as $language): ?>
            <div style="margin-top: 10px">
                <div class="row-2">
                    <div class="col-20">
                        <?= $language["language"] ?>
                    </div>
                    <div class="col-20">
                        <?= $language["speaking"] ?>
                    </div>
                    <div class="col-20">
                        <?= $language["writing"] ?>
                    </div>
                    <div class="col-20">
                        <?= $language["reading"] ?>
                    </div>
                    <form method="POST" action="<?= base_url("candidate/profile/language/delete") ?>" id="delete-btn-<?= $index ?>" class="delete-btn">
                        <input name="index" value="<?= $index ?>" hidden>
                        <div onclick="deleteLanguage(<?= $index ?>)">Delete</div>
                    </form>
                </div>
            </div>
            <?php $index += 1 ?>
        <?php endforeach ?>
    <?php endif ?>
<?php $this->endSection() ?>