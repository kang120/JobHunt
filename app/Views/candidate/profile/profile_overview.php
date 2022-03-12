<?php $this->extend("candidate/profile/profile_layout") ?>

<?php $this->section("profile-detail") ?>
    <?php if($isEmptyProfile): ?>
        <div style="width: fit-content; margin: auto; text-align: center; margin-top: 100px">
            <img src="<?= base_url("assets/edit_profile.png") ?>" width="200px" height="200px">
            <div style="font-size: 1.5em; margin-top: 30px;">You haven't set up your profile</div>
            <button class="btn btn-gray" style="margin-top: 20px; width: 250px" onclick="first_setup_profile()">Set up now</button>
        </div>
    <?php else: ?>
        <?php if(!is_null($educations)): ?>
            <div style="font-size: 1.5em; margin-bottom: 20px; color: #ed6d6d;"><b>Educations</b></div>
            <?php foreach($educations as $education): ?>
                <div class="education-box">
                    <div class="row-1">
                        <div class="col-30">
                            <?= $education["graduationDate"] ?>
                        </div>
                        <div class="col-70" style="font-size: 1.5em">
                            <b><?= $education["universityName"] ?></b>
                        </div>
                    </div>
                    <div class="row-2" style="margin-top: 5px">
                        <div class="col-30"></div>
                        <div class="col-70">
                            <?= $education["course"] ?>, <?= $education["universityLocation"] ?>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
            <hr style="margin-top: 40px; border: 2px solid gray; border-radius: 50px">
        <?php endif ?>

        <?php if(!is_null($experiences)): ?>
            <div style="font-size: 1.5em; margin-top: 35px; margin-bottom: 20px; color: #ed6d6d;"><b>Experiences</b></div>
            <?php foreach($experiences as $experience): ?>
                <div class="experience-box" style="margin-top: 30px">
                    <div class="row-1">
                        <div class="col-30">
                            <?= $experience["startDate"] ?> - <?= $experience["endDate"] ?>
                        </div>
                        <div class="col-70" style="font-size: 1.5em;">
                            <b><?= $experience["jobTitle"] ?></b>
                        </div>
                    </div>
                    <div class="row-2" style="margin-top: 5px">
                        <div class="col-30"></div>
                        <div class="col-70">
                            <?= $experience["companyName"] ?>
                        </div>
                    </div>
                    <div class="row-3">
                        <div class="col-30"></div>
                        <div class="col-70">
                            <table width="100%" class="experience-table">
                                <col width="25%">
                                <col width="75%">
                                <tr>
                                    <td style="color: gray">Specialization: </td>
                                    <td><?= $experience["specialization"] ?></td>
                                </tr>
                                <tr>
                                    <td style="color: gray">Role: </td>
                                    <td><?= $experience["role"] ?></td>
                                </tr>
                                <tr>
                                    <td style="color: gray">salary: </td>
                                    <td><?= $experience["salary"] ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
            <hr style="margin-top: 40px; border: 2px solid gray; border-radius: 50px">
        <?php endif ?>

        <?php if(!is_null($skills)): ?>
            <div style="font-size: 1.5em; margin-top: 35px; margin-bottom: 20px; color: #ed6d6d;"><b>Skills</b></div>
            <div class="row-1" style="margin-top: 30px; margin-bottom: 10px">
                <div class="col-30">
                    <b>Skill</b>
                </div>
                <div class="col-70">
                    <b>Proficiency (1-10)</b>
                </div>
            </div>
            <hr style="margin-bottom: 15px;">
            <?php foreach($skills as $skill): ?>
                <div style="margin-top: 10px">
                    <div class="row-2">
                        <div class="col-30">
                            <?= $skill["skillName"] ?>
                        </div>
                        <div class="col-70">
                            <?= $skill["proficiency"] ?>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
            <hr style="margin-top: 40px; border: 2px solid gray; border-radius: 50px">
        <?php endif ?>

        <?php if(!is_null($languages)): ?>
            <div style="font-size: 1.5em; margin-top: 35px; margin-bottom: 20px; color: #ed6d6d;"><b>Languages</b></div>
            <div class="row-1" style="margin-top: 30px; margin-bottom: 10px">
                <div class="col-30">
                    <b>Language</b>
                </div>
                <div class="row-1 col-70">
                    <div class="col-30">
                        <b>Speaking (1-10)</b>
                    </div>
                    <div class="col-30">
                        <b>Writing (1-10)</b>
                    </div>
                    <div class="col-30">
                        <b>Reading (1-10)</b>
                    </div>
                </div>
            </div>
            <hr style="margin-bottom: 15px;">
            <?php foreach($languages as $language): ?>
                <div style="margin-top: 10px">
                    <div class="row-2">
                        <div class="col-30">
                            <?= $language["language"] ?>
                        </div>
                        <div class="row-2 col-70">
                            <div class="col-30">
                                <?= $language["speaking"] ?>
                            </div>
                            <div class="col-30">
                                <?= $language["writing"] ?>
                            </div>
                            <div class="col-30">
                                <?= $language["reading"] ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        <?php endif ?>
    <?php endif ?>
<?php $this->endSection() ?>