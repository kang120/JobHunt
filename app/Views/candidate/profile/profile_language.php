<?php $this->extend("candidate/profile/profile_layout") ?>

<?php $this->section("profile-detail") ?>
    <div style="display: flex;"><div id="add-btn" class="add-btn" onclick="showAddEducationForm()">Add</div></div>

    <form id="add-profile-form" class="add-profile-form" action="<?= base_url("/candidate/profile/language") ?>" method="POST">
        <table width="100%">
            <col width="25%">
            <col width="75%">
            <tr>
                <td><label>Language</label></td>
                <td style="padding-left: 25px"><input class="form-input" type="text"></td>
            </tr>
            <tr>
                <td><label>Speaking</label></td>
                <td style="padding-left: 25px">
                    <input class="form-input" style="width: 30%;" type="number" min="1" max="10">
                </td>
            </tr>
            <tr>
                <td><label>Writing</label></td>
                <td style="padding-left: 25px"><input class="form-input" style="width: 30%;" type="number" min="1" max="10"></td>
            </tr>
            <tr>
                <td><label>Reading</label></td>
                <td style="padding-left: 25px"><input class="form-input" style="width: 30%;" type="number" min="1" max="10"></td>
            </tr>
        </table>
        <div class="form-btn-box">
            <input class="btn btn-success" type="submit" value="Save">
            <input class="btn btn-primary" style="margin-left: 10px" type="button" value="Cancel" onclick="closeAddProfileForm()">
        </div>
    </form>

    <?php if(is_null($profile) || is_null($profile["EDUCATION"])): ?>
        <div style="width: fit-content; margin: auto; text-align: center; margin-top: 100px">
            <ion-icon name="language-outline" style="font-size: 200px"></ion-icon>
            <!-- <img src="<?= base_url("assets/edit_profile.png") ?>" width="200px" height="200px"> -->
            <div style="font-size: 1.5em; margin-top: 30px;">Your language is empty</div>
        </div>
    <?php endif ?>
<?php $this->endSection() ?>