<?php $this->extend("layout") ?>

<?php $this->section("title") ?>
    <title>Job Hunt - Sign up</title>
<?php $this->endSection() ?>

<?php $this->section("content") ?>
    <link rel="stylesheet" href="<?= base_url("css/candidate/signup.css") ?>">

    <main>
        <div style="font-size: 2.5em;">Sign Up</div>
        <form id="signup-form" method="POST" action="">
            <table style="margin: auto; width: 100%">
                <tr>
                    <td style="width: 50%;">
                        <label>First Name</label><br>
                        <input name="firstname" value="<?= isset($validation) ? $firstname : "" ?>" type="text" style="width: 90%;"><br>
                        <div class="error-msg"><?= isset($validation) ? $validation->getError("firstname") : "" ?></div>
                    </td>                              
                    <td style="width: 50%; vertical-align: top;">
                        <label style="padding-left: 10%">Last Name</label><br>
                        <input name="lastname" value="<?= isset($validation) ? $lastname : "" ?>" type="text" style="width: 90%; margin-left: 10%;"><br>
                        <div class="error-msg" style="margin-left: 10%;"><?= isset($validation) ? $validation->getError("lastname") : "" ?></div>
                    </td>
                </tr>
                <tr>
                    <td colspan=2>
                        <label>Email</label><br>
                        <input id="email" name="email" value="<?= isset($validation) ? $email : "" ?>" type="text" style="width: 100%"><br>
                        <div class="error-msg"><?= isset($validation) ? $validation->getError("email") : "" ?></div>
                    </td>
                </tr>
                <tr>
                    <td colspan=2>
                        <label>Password</label><br>
                        <input name="password" type="password" style="width: 100%">
                        <div class="error-msg"><?= isset($validation) ? $validation->getError("password") : "" ?></div>
                    </td>
                </tr>
                <tr>
                    <td colspan=2>
                        <label>Confirmed Password</label><br>
                        <input name="password2" type="password" style="width: 100%">
                        <div class="error-msg"><?= isset($validation) ? $validation->getError("password2") : "" ?></div>
                    </td>
                </tr>
                <tr>
                    <td colspan=2>
                        <input type="submit" value="Submit" style="width: 100%">
                    </td>
                </tr>
            </table>
            <hr>
            <div style="margin-top: 15px;">
                <span>Already has account?</span>
                <span style="margin-left: 7px;"><a class="login-option" href="<?= base_url("candidate/login") ?>">Log in</a></span>
            </div>
        </form>
    </main>
<?php $this->endSection() ?>