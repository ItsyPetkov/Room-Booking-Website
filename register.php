<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="register.css"/>
    <title>Registration Page</title>
</head>
<body>
<div class="page-header">
    <h1>Welcome to our website</h1>
</div>
<div class="form">
    <div class="header">
        <h1>Registration Details</h1>
        <p>In order to create an account, please fill in the following</p>
    </div>
    <form method="post" action="register.php">
        <div class = "email">
            Email: <input type="text" name="email" placeholder="Please enter an email." value="<?php if(isset($_POST['Register'])){echo $_POST['email'];} ?>" required/><br><br>
        </div class = "password">
        <div class = "password">
            Password: <input type="password" name="password" placeholder="Please enter a password" value="<?php if(isset($_POST['Register'])){echo $_POST['password'];} ?>" required/><br><br>
        </div>
        <div class="button">
            <input type="submit" name="Register" value="Register"/>
        </div>
        <p>
            Already registered? <a href="login.php">Login here</a>
        </p>
    </form>
</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>