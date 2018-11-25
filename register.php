<?php

    if(isset($_GET["user-type"])) {
        $user_type = $_GET["user-type"];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="register.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <title>Registration Page</title>
</head>
<body>
<?php //include("includes/header.php"); ?>

<?php if (!isset($user_type)) { ?>
    <div class="container text-center user-types-container">
        <div class="row">
            <div class="col-12">
                <h1>Don't have an account?</h1>
            </div>
        </div>
        <div class="row d-flex h-100">
            <div class="col-5">
                <a href="register.php?user-type=normal">
                    <div class="user-type">
                        <i class="fas fa-user"></i>
                        <p>Register as a normal user</p>
                    </div>
                </a>
            </div>
            <div class="col-2 justify-content-center align-self-center">
                or
            </div>
            <div class="col-5">
                <a href="register.php?user-type=corp">
                    <div class="user-type">
                        <i class="fas fa-user-tie"></i>
                        <p>Register as a corporation user</p>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p>Already registered? <a href="login.php">Login here</a></p>
            </div>
        </div>
    </div>
<?php } elseif($user_type == "normal") { ?>
    <div class="container slected-user-container">
        <div class="row">
            <div class="col-12">
                <div class="user-type">
                    <i class="fas fa-user"></i>
                    <p>Register as a normal user</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="header">
                    <h1>Registration Details</h1>
                    <p>In order to create an account, please fill in the following</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form class="needs-validation" novalidate action="" method="post">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name:</label>
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Please enter a name." autocomplete="off" value="<?php if(isset($_POST['Register'])){echo $_POST['name'];} ?>" required>
                            <div class="invalid-feedback">
                                Please, enter a name.
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">E-Mail:</label>
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" name="email" id="email" placeholder="Please enter an email." autocomplete="off" value="<?php if(isset($_POST['Register'])){echo $_POST['email'];} ?>" required>
                            <div class="invalid-feedback">
                                Please, enter an email.
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Password:</label>
                        <div class="col-md-6 mb-3">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Please enter a password." autocomplete="off" value="<?php if(isset($_POST['Register'])){echo $_POST['password'];} ?>" required>
                            <div class="invalid-feedback">
                                Please, enter a password.
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-outline-primary" name="Register">Register</button>

                    <p>Already registered? <a href="login.php">Login here</a></p>

                </form>
            </div>
        </div>

    </div>
<?php } elseif($user_type == "corp") { ?>
    <div class="container slected-user-container">
        <div class="row">
            <div class="col-12">
                <div class="user-type">
                    <i class="fas fa-user-tie"></i>
                    <p>Register as a corporation user</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="header">
                    <h1>Registration Details</h1>
                    <p>In order to create an account, please fill in the following</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form class="needs-validation" novalidate action="" method="post">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name:</label>
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Please enter a name." autocomplete="off" value="<?php if(isset($_POST['Register'])){echo $_POST['name'];} ?>" required>
                            <div class="invalid-feedback">
                                Please, enter a name.
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">E-Mail:</label>
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" name="email" id="email" placeholder="Please enter an email." autocomplete="off" value="<?php if(isset($_POST['Register'])){echo $_POST['email'];} ?>" required>
                            <div class="invalid-feedback">
                                Please, enter an email.
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Password:</label>
                        <div class="col-md-6 mb-3">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Please enter a password." autocomplete="off" value="<?php if(isset($_POST['Register'])){echo $_POST['password'];} ?>" required>
                            <div class="invalid-feedback">
                                Please, enter a password.
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="institute" class="col-sm-2 col-form-label">Institute:</label>
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" name="institute" id="institute" placeholder="Please enter an institute." autocomplete="off" value="<?php if(isset($_POST['Register'])){echo $_POST['institute'];} ?>" required>
                            <div class="invalid-feedback">
                                Please, enter an institute.
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-outline-primary" name="Register">Register</button>

                    <p>Already registered? <a href="login.php">Login here</a></p>

                </form>
            </div>
        </div>

    </div>
<?php } else { ?>

<?php } ?>

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
            include("includes/config.php");
            include("includes/db.php");

            $name = mysqli_real_escape_string($db, $_POST['name']);
            $email = mysqli_real_escape_string($db, $_POST['email']);
            $password = mysqli_real_escape_string($db, $_POST['password']);
            if(isset($_POST['institute'])) {
                $institute = mysqli_real_escape_string($db, $_POST['institute']);
            } else {
                $institute = "";
            }
            $encryptedPassword = md5($password);



            $sql = "SELECT * FROM `cs312groupk`.`users` WHERE `email` = '$email'";
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $result = $db->query($sql);
                if (mysqli_num_rows($result) == 1) {
                    echo "User already exists";
                } else {
                    $sql2 = "INSERT INTO `cs312groupk`.`users` (`name`,`password`,`email`,`id`,`institute`) VALUES ('$name', '$encryptedPassword', '$email', NULL, '$institute');";
                    if($result2 = $db->query($sql2)) {
                        header("location:login.php");
                    } else {
                        echo "Something went wrong with creating your account!";
                    }
//                    if(empty($institute)){
//                        $_SESSION['name'] = $name;
//                        $_SESSION['email'] = $email;
//                        $_SESSION['user-type'] = 'normal';
//                        header("Location: userhome.php");
//                    }else{
//                        $_SESSION['name'] = $name;
//                        $_SESSION['email'] = $email;
//                        $_SESSION['user-type'] = 'owner';
//                        header("Location: ownerhome.php");
//                    }

                }
            } else {
                echo "Invalid email! Please enter a valid email";
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