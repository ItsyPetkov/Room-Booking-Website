<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="login.css"/>
    <title>Log in Authentication Page</title>
</head>
<body>
<div class="page-header">
    <h1>Welcome to our website</h1>
</div>
<div class="form">
    <div class="header">
        <h1>Login Details</h1>
        <p>In order to login to your account, please fill in the following</p>
    </div>

    <form method="post" action="login.php">
        <div class = "email">
            Email: <input type="text" name="email" placeholder="Please enter an email." value="<?php if(isset($_POST['LogIn'])){echo $_POST['email'];} ?>" required/><br><br>
        </div>
        <div class = "password">
            Password: <input type="password" name="password" placeholder="Please enter a password" value="<?php if(isset($_POST['LogIn'])){echo $_POST['password'];} ?>" required/><br><br>
        </div>
        <div class = "button">
            <input type="submit" name="LogIn" value="LogIn"/>
        </div>
        <p>
            Don't have an account? <a href="register.php">Register Now</a>
        </p>
        <p>
            Forgotten Password? <a href="newPass.php">Reset Password</a>
        </p>
    </form>
</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
