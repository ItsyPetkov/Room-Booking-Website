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
            <input type="submit" name="LogIn" value="Log In"/>
        </div>
        <p>
<!--            <a href="#" class="btn btn-link btn-sm" role="button" name="pwdreset">Don't remember your password?</a>-->
            <input type="submit" name="pwdreset" value="Reset Pass">
        </p>
        <p>
            Don't have an account? <a href="register.php">Register Now</a>
        </p>
        <p>
            Don't like your password? <a href="newPass.php">Reset Password</a>
        </p>
    </form>
</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
<?php
    $email = isset($_POST["email"])? $_POST["email"]: "";
    $pwd = isset($_POST["password"])? $_POST["password"]: "";
    $invalidinfo = 0;

    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $invalidinfo = 1;
    }

    if(empty($pwd) || preg_match('/\s/', $pwd))
    {
        $invalidinfo = 1;
    }

    if($invalidinfo === 0)
    {
        //Connect to the database
        $host = "devweb2018.cis.strath.ac.uk";
        $user = "cs312groupk";
        $password = "aeCh1ang9ahm";
        $dbname = "cs312groupk";
        $conn = new mysqli($host, $user, $password, $dbname);

        if(isset($_POST['LogIn'])) {
            $encryptedPassword = md5($pwd);
            $sql = "SELECT * FROM `cs312groupk`.`users` WHERE `email` = '$email' AND `password` = '$encryptedPassword'";
            $result = $conn->query($sql);

            if(mysqli_num_rows($result) == 1){
               $_SESSION['email'] = $email;
                header("Location: mainPage.php");
            }else{
                echo "Wrong email or password.";
            }
        }

        if(isset($_POST["pwdreset"]))
        {
            $email_found = 0;
            $sql = "SELECT * FROM users";
            $result = $conn->query($sql);

            if ($result->num_rows > 0)
            {
                while ($row = $result->fetch_assoc())
                {
                    if($row["email"] === $email)
                    {
                        $email_found = 1;
                        break;
                    }
                }
            }

            if($email_found === 1)
            {
                $newpwd = rand();
                $new_encr_pwd = md5($newpwd);
                $message = "Your new password is $newpwd";
                mail($email, "Password Reset - Group K's Website", $message);
                $sql = "UPDATE users SET password = '$new_encr_pwd' WHERE email = '$email'";

                if ($conn->query($sql) === TRUE)
                {
                    echo "<div>Password updated successfully!</div>";
                    echo "<div>Your new password has been sent to: $email</div>";
                }
                else
                {
                    echo "<div>Error updating record: " . $conn->error . "</div>";
                }
            }

            else
            {
                echo "<div>No such email found</div>";
            }
        }


    }
?>
