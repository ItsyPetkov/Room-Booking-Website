<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
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
    <form class="needs-validation" novalidate action="" method="post">
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">E-Mail: </label>
            <div class="col-md-6 mb-3">
                <input type="text" class="form-control" name="email" id="email" placeholder="Please enter an email." autocomplete="off" value="<?php if(isset($_POST['Register'])){echo $_POST['email'];} ?>" required>
                <div class="invalid-feedback">
                    Please, enter an email.
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-sm-2 col-form-label">Passowrd: </label>
            <div class="col-md-6 mb-3">
                <input type="password" class="form-control" name="password" id="password" placeholder="Please enter a password." autocomplete="off" value="<?php if(isset($_POST['Register'])){echo $_POST['password'];} ?>" required>
                <div class="invalid-feedback">
                    Please, enter a password.
                </div>
            </div>
        </div>
        <div class = "button">
            <button type="submit" class="btn btn-outline-primary" name="LogIn">Log In</button>
        </div>
    </form>
</div>
<div>
    <?php

    session_start();

    //Connect to the database
    $host = "devweb2018.cis.strath.ac.uk";
    $user = "cs312groupk";
    $password = "aeCh1ang9ahm";
    $dbname = "cs312groupk";
    $conn = new mysqli($host, $user, $password, $dbname);

    $email = isset($_POST["email"])? mysqli_real_escape_string($conn, $_POST["email"]): "";
    $pwd = isset($_POST["password"])? mysqli_real_escape_string($conn, $_POST["password"]): "";
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


        if(isset($_POST['LogIn']))
        {
            $encryptedPassword = md5($pwd);
            $sql = "SELECT * FROM `cs312groupk`.`users` WHERE `email` = '$email' AND `password` = '$encryptedPassword'";
            $result = $conn->query($sql);

            if(mysqli_num_rows($result) == 1)
            {
                $sql2 = "SELECT * FROM users";
                $result2 = $conn->query($sql2);
                if($result2)
                {
                    if ($result2->num_rows > 0)
                    {
                        while ($row = $result2->fetch_assoc())
                        {
                            if($row["email"] === $email && $row['institute'] === null)
                            {
                                $_SESSION['id'] = $row['id'];
                                $_SESSION['name'] = $row['name'];
                                $_SESSION['email'] = $email;
                                header("Location: userhome.php");
                                break;
                            }

                            elseif($row["email"] === $email && $row['institute'] != null)
                            {
                                $_SESSION['id'] = $row['id'];
                                $_SESSION['name'] = $row['name'];
                                $_SESSION['email'] = $email;
                                header("Location: onwerhome.php");
                                break;
                            }
                        }
                    }
                }
            }
            else
            {
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
</div>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

    // Enables only numeric input
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
    // Function for changing the tabs from the form step wizard
    function selectStep(evt, tabName, flag) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("nav-link");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";

        if (evt.currentTarget.type == "button") {
            tablinks = document.getElementsByClassName(tabName);
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className += " active";
            }
        } else {
            evt.currentTarget.className += " active";
        }
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>
</body>
</html>
