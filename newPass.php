<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <link rel="stylesheet" type="text/css" href="newPass.css"/>
    <title>Reset Password</title>
</head>
<body>
    <div class="page-header">
        <h1>Welcome to our website</h1>
    </div>
    <div class="form">
        <div class="header">
            <h1>Reset Password Details</h1>
            <p>To reset your password please fill in the following...</p>
        </div>
        <form method="post" action="newPass.php">
            <div class = "email">
                <input type="text" name="email" placeholder="Enter your email here." value="<?php if(isset($_POST['change'])){echo $_POST['email'];} ?>" required/><br><br>
            </div>
            <div class="password">
                <input type="password" name="password"  placeholder="Enter new password here." value="<?php if(isset($_POST['change'])){echo $_POST['password'];} ?>" required/><br><br>
            </div>
            <div class="button">
                <input type="submit" name="change" value="Change Password"/>
            </div>
        </form>
    </div>

<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
<!--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
</body>
</html>

<?php
/**
 * Created by IntelliJ IDEA.
 * User: PC
 * Date: 11/2/2018
 * Time: 10:12 PM
 */