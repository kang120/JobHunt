<html>

    <head>
        <title>JMS Login</title>
        <link rel="stylesheet" href="<?= base_url("css/admin/login.css") ?>">
        <link rel="stylesheet" href="<?= base_url("css/button.css") ?>">
    </head>

    <body>
        <form method="POST" style="margin: auto; width: 30%; text-align: center;">
            <div style="font-size: 1.5em; color: gray; margin-bottom: 40px">Job Hunt Management System - JMS</div>

            <input name="username" type="text" value="<?= isset($username) ? $username : "" ?>" placeholder="Username"><br>
            <div class="error-msg"><?= isset($validation) ? $validation->getError("username") : "" ?></div>

            <input name="password" type="text" placeholder="Password"><br>
            <div class="error-msg"><?= isset($validation) ? $validation->getError("password") : "" ?></div>
            <div class="error-msg"><?= isset($passwordError) ? $passwordError : "" ?></div>

            <input class="btn btn-gray" style="margin-top: 30px; background: white;" type="submit" value="Log in">
        </form>
    </body>

</html>