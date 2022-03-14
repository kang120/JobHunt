<?php $this->extend("employer/layout") ?>

<?php $this->section("title") ?>
    <title>Job Hunt - Employer</title>
<?php $this->endSection() ?>

<?php $this->section("content") ?>
    <link rel="stylesheet" href="<?= base_url("css/candidate/signup.css") ?>">

    <main>
        <div style="font-size: 2.5em;">Employer Login</div>
        <form id="signup-form" method="POST" action="">
            <table style="margin: auto; width: 100%">
                <tr>
                    <td>
                        <label>Email</label><br>
                        <input id="email" name="email" value="<?= isset($email) ? $email : "" ?>" type="text" style="width: 100%"><br>
                        <div class="error-msg"><?= isset($validation) ? $validation->getError("email") : "" ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Password</label><br>
                        <input name="password" type="password" style="width: 100%">
                        <div class="error-msg"><?= isset($validation) ? $validation->getError("password") : "" ?></div>
                        <div class="error-msg"><?= isset($passwordError) ? $passwordError : "" ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="Submit" style="width: 100%">
                    </td>
                </tr>
            </table>
            <hr>
            <div style="margin-top: 15px;">
                <span>No account yet?</span>
                <span style="margin-left: 7px;"><a class="login-option" href="<?= base_url("employer/signup") ?>">Sign up now</a></span>
            </div>
        </form>
    </main>
<?php $this->endSection() ?>