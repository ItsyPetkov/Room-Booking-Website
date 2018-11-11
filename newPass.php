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
                Email: <input type="text" name="email" placeholder="Enter your email here." value="<?php if(isset($_POST['change'])){echo $_POST['email'];} ?>" required/><br><br>
            </div>
            <div class="oldPass">
                Old Password: <input type="password" name="oldPass" placeholder="Your old password here" value="<?php if(isset($_POST['change'])){echo $_POST['oldPass'];} ?>"><br><br>
            </div>
            <div class="newPass">
                New Password: <input type="password" name="newPass"  placeholder="Your new password here." value="<?php if(isset($_POST['change'])){echo $_POST['newPass'];} ?>" required/><br><br>
            </div>
            <div class="button">
                <input type="submit" name="change" value="Change Password"/>
            </div>
        </form>
    </div>
    <div>
        <?php
        /**
         * Created by IntelliJ IDEA.
         * User: Hristo Petkov
         * Date: 10/25/2018
         * Time: 6:03 PM
         */

        if(isset($_POST['change'])){
            $email = $_POST['email'];
            $oldpassword = $_POST['oldPass'];
            $newpassword = $_POST['newPass'];
            $encPass = md5($oldpassword);

            //Connect to the Database
            $serverName = "devweb2018.cis.strath.ac.uk";
            $userName = "cs312groupk";
            $password = "aeCh1ang9ahm";
            $dbname = $userName;
            $conn = new mysqli($serverName, $userName, $password, $dbname);
            if($conn->connect_error){
                die("Failed to connect to database");
            }

            $sql = "SELECT * FROM `cs312groupk`.`users` WHERE `email` = '$email' AND `password` = '$encPass'";
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                $result = $conn->query($sql);

                if(mysqli_num_rows($result) == 1){
                    $newEncryptedPassword = md5($newpassword);
                    $sql2 = "UPDATE `cs312groupk`.`users` SET `password` = '$newEncryptedPassword' WHERE `email` = '$email'";
                    $result2 = $conn->query($sql2);
                    if($result2){
                        echo "Password reset successful</br>";
                        echo "To go back to the Login page please click <a href='login.php'> here </a>";
                    }else{
                        echo "Password reset failed, please try again!";
                    }
                }else{
                    echo "Unknown email, please try again.";
                }
            }else{
                echo "Invalid email please try again";
            }

        }
        ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
