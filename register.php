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
        <div class = "name">
            Name: <input type="text" name="name" placeholder="Please enter a name." value="<?php if(isset($_POST['Register'])){echo $_POST['name'];} ?>"  required/><br><br>
        </div>
        <div class = "email">
            Email: <input type="text" name="email" placeholder="Please enter an email." value="<?php if(isset($_POST['Register'])){echo $_POST['email'];} ?>" required/><br><br>
        </div>
        <div class = "password">
            Password: <input type="password" name="password" placeholder="Please enter a password" value="<?php if(isset($_POST['Register'])){echo $_POST['password'];} ?>" required/><br><br>
        </div>
        <div class = "institution">
            Institution: <input type="text" name="institute" placeholder="Please enter a institute" value="<?php if(isset($_POST['Register'])){echo $_POST['institute'];} ?>" required/><br><br>
        </div>
        <div class="button">
            <input type="submit" name="Register" value="Register"/><br><br>
        </div>
        <p>
            Already registered? <a href="login.php">Login here</a>
        </p>
    </form>
</div>
<div>
    <?php
    /**
     * Created by IntelliJ IDEA.
     * User: Hristo Petkov
     * Date: 10/23/2018
     * Time: 6:10 PM
     */

    session_start();

    if(isset($_POST['Register'])){
        if(empty($_POST['password']) || preg_match('/\s/', $_POST['password']))
        {
            echo "No spaces allowed in new password!";
        }
        else {

            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $institute = $_POST['institute'];
            $encryptedPassword = md5($password);

            //Connect to the Database
            $serverName = "devweb2018.cis.strath.ac.uk";
            $userName = "cs312groupk";
            $password = "aeCh1ang9ahm";
            $dbname = $userName;
            $conn = new mysqli($serverName, $userName, $password, $dbname);
            if ($conn->connect_error) {
                die("Fialed to connect to database");
            }

            $sql = "SELECT * FROM `cs312groupk`.`users` WHERE `email` = '$email'";
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $result = $conn->query($sql);
                if (mysqli_num_rows($result) == 1) {
                    echo "User already exists";
                } else {
                    $sql2 = "INSERT INTO `cs312groupk`.`users` (`name`,`password`,`email`,`id`,`institute`) VALUES ('$name', '$encryptedPassword', '$email', NULL, '$institute');";
                    $result2 = $conn->query($sql2);
                    $_SESSION['email'] = $email;
                    header("Location: mainPage.php");
                }
            } else {
                echo "Invalid email! Please enter a valid email";
            }
        }
    }
    ?>
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>