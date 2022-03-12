<?php

use App\Models\ProfileModel;

 $this->extend("candidate/profile/profile_layout") ?>

<?php
    $profileModel = new ProfileModel();
    $x = $profileModel->getProfileByCandidateId(3);
?>

<?php $this->section("profile-detail") ?>
    <div style="display: flex;"><div id="add-btn" class="add-btn <?= isset($validation) ? "hide" : "show" ?>" onclick="showAddEducationForm()">Add</div></div>

    <form id="add-profile-form" class="add-profile-form add-education-form <?= isset($validation) ? "show" : "hide" ?>" action="<?= base_url("/candidate/profile/experience") ?>" method="POST">
        <div class="row">
            <div class="col-25">
                <label>Job Title</label>
            </div>
            <div class="col-75">
                <input class="form-input" name="job_title" type="text">
            </div>
        </div>
        <div class="error-msg"><?= isset($validation) ? $validation->getError("job_title") : "" ?></div>
        <div class="row">
            <div class="col-25">
                <label>Company Name</label>
            </div>
            <div class="col-75">
                <input class="form-input" name="company_name" type="text">
            </div>
        </div>
        <div class="error-msg"><?= isset($validation) ? $validation->getError("company_name") : "" ?></div>
        <div class="row">
            <div class="col-25">
                <label>Duration</label>
            </div>
            <div class="col-75">
                <input class="form-input" name="start_month" style="width: 20%;" type="number" min="1" max="12" placeholder="Month">
                <input class="form-input" name="start_year" style="margin-left: 5px; margin-right: 5px; width: 20%;" type="number" min="1962" max="2030" placeholder="Year">
                To
                <input class="form-input" name="end_month" style="margin-left: 5px; width: 20%;" type="number" min="1" max="12" placeholder="Month">
                <input class="form-input" name="end_year" style="margin-left: 5px; width: 20%;" type="number" min="1962" max="2030" placeholder="Year">
            </div>
        </div>
        <div class="col-75" style="display: flex; margin-left: 30%">
            <div class="error-msg" style="margin-left: 0; width: 22%"><?= isset($validation) ? $validation->getError("start_month") : "" ?></div>
            <div class="error-msg" style="margin-left: 8px; width: 22%"><?= isset($validation) ? $validation->getError("start_year") : "" ?></div>
            <div class="error-msg" style="margin-left: 30px; width: 22%"><?= isset($validation) ? $validation->getError("end_month") : "" ?></div>
            <div class="error-msg" style="margin-left: 0px; width: 22%"><?= isset($validation) ? $validation->getError("end_year") : "" ?></div>
        </div>
        <div class="row">
            <div class="col-25">
                <label>Specialization</label>
            </div>
            <div class="col-75">
                <input class="form-input" name="specialization" type="text">
            </div>
        </div>
        <div class="error-msg"><?= isset($validation) ? $validation->getError("specialization") : "" ?></div>
        <div class="row">
            <div class="col-25">
                <label>Role</label>
            </div>
            <div class="col-75">
                <input class="form-input" name="role" type="text">
            </div>
        </div>
        <div class="error-msg"><?= isset($validation) ? $validation->getError("role") : "" ?></div>
        <div class="row">
            <div class="col-25">
                <label>Salary</label>
            </div>
            <div class="col-75">
                <input class="form-input" name="salary" type="text">
            </div>
        </div>
        <div class="error-msg"><?= isset($validation) ? $validation->getError("salary") : "" ?></div>
        <div class="form-btn-box">
            <input class="btn btn-success" type="submit" value="Save">
            <input class="btn btn-primary" style="margin-left: 10px" type="button" value="Cancel" onclick="closeAddProfileForm()">
        </div>
    </form>
    
    <?php if(is_null($profile) || is_null($profile["EXPERIENCE"])): ?>
        <div style="width: fit-content; margin: auto; text-align: center; margin-top: 100px">
            <ion-icon name="briefcase-outline" style="font-size: 200px"></ion-icon>
            <!-- <img src="<?= base_url("assets/edit_profile.png") ?>" width="200px" height="200px"> -->
            <div style="font-size: 1.5em; margin-top: 30px;">Your experience is empty</div>
        </div>
    <?php else: ?>
        <?php $index = 0 ?>
        <?php foreach($experiences as $experience): ?>
            <div style="margin-top: 50px">
                <div class="row-1">
                    <div class="col-30">
                        <?= $experience["startDate"] ?> - <?= $experience["endDate"] ?>
                    </div>
                    <div class="col-70" style="font-size: 1.5em">
                        <b><?= $experience["jobTitle"] ?></b>
                    </div>
                    <form method="POST" action="<?= base_url("candidate/profile/experience/delete") ?>" id="delete-btn-<?= $index ?>" class="delete-btn">
                        <input name="index" value="<?= $index ?>" hidden>
                        <div onclick="deleteExperience(<?= $index ?>)">Delete</div>
                    </form>
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
            <?php $index += 1 ?>
        <?php endforeach ?>
    <?php endif ?>
<?php $this->endSection() ?>