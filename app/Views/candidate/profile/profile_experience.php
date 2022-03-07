<?php $this->extend("candidate/profile/profile_layout") ?>

<?php $this->section("profile-detail") ?>
    <div style="display: flex;"><div id="add-btn" class="add-btn" onclick="showAddEducationForm()">Add</div></div>

    <form id="add-profile-form" class="add-profile-form add-education-form" action="<?= base_url("/candidate/profile/experience") ?>" method="POST">
        <table width="100%">
            <col width="25%">
            <col width="75%">
            <tr>
                <td><label>Job Title</label></td>
                <td style="padding-left: 25px"><input class="form-input" type="text"></td>
            </tr>
            <tr>
                <td><label>Company Name</label></td>
                <td style="padding-left: 25px"><input class="form-input" type="text"></td>
            </tr>
            <tr>
                <td><label>Duration</label></td>
                <td style="padding-left: 25px">
                    <input class="form-input" style="width: 15%;" type="number" min="1" max="12" placeholder="Month">
                    <input class="form-input" style="margin-left: 15px; margin-right: 15px; width: 15%;" type="number" min="1962" max="2030" placeholder="Year">
                    To
                    <input class="form-input" style="margin-left: 15px; width: 15%;" type="number" min="1" max="12" placeholder="Month">
                    <input class="form-input" style="margin-left: 15px; width: 15%;" type="number" min="1962" max="2030" placeholder="Year">
                </td>
            </tr>
            <tr>
                <td><label>Specialization</label></td>
                <td style="padding-left: 25px"><input class="form-input" type="text"></td>
            </tr>
            <tr>
                <td><label>Role</label></td>
                <td style="padding-left: 25px"><input class="form-input" type="text"></td>
            </tr>
            <tr>
                <td><label>Salary</label></td>
                <td style="padding-left: 25px"><input class="form-input" type="text"></td>
            </tr>
        </table>
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
    <?php endif ?>
<?php $this->endSection() ?>