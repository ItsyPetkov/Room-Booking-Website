<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="login.css"/>
    <title>Change Password</title>
</head>
<body>
<?php
session_start();
?>
<div class="container text-center">
    <div class="row">
        <div class="col-12">
            <div class="header">
                <h1>Change your password</h1>
                <p>In order to change to your password, please fill in the following</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <form class="needs-validation" novalidate action="" method="post">
                <div class="form-group row">
                    <div class="col-md-4 offset-md-4 mb-3">
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email address" autocomplete="off" value="<?php echo $_SESSION['email']; ?>" required>
                        <div class="invalid-feedback">Please, enter an email!</div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-4 offset-md-4 mb-3">
                        <input type="password" class="form-control" name="oldPass" id="password" placeholder="Old Password" autocomplete="off" value="<?php if(isset($_POST['change'])){echo $_POST['oldPass'];} ?>" required>
                        <div class="invalid-feedback">Please, enter a password!</div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-4 offset-md-4 mb-3">
                        <input type="password" class="form-control" name="newPass" id="password" placeholder="New Password" autocomplete="off" value="<?php if(isset($_POST['change'])){echo $_POST['newPass'];} ?>" required>
                        <div class="invalid-feedback">Please, enter a password!</div>
                    </div>
                </div>
                <div class="button">
                    <button type="submit" class="btn btn-outline-primary" name="change">Change Password</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
<!--            <p class="error">--><?php //echo $wrong_acc_info; ?><!--</p>-->
<!--            <p class="error">--><?php //echo $update_state; ?><!--</p>-->
<!--            <p class="error">--><?php //echo $new_pass_info; ?><!--</p>-->
<!--            <p class="error">--><?php //echo $no_such_email; ?><!--</p>-->
        </div>
    </div>
</div>
    <div>
        <?php
        /**
         * Created by IntelliJ IDEA.
         * User: Hristo Petkov
         * Date: 10/25/2018
         * Time: 6:03 PM
         */


        if(isset($_POST['change'])) {
            if (empty($_POST['newPass']) || preg_match('/\s/', $_POST['newPass'])) {
                echo "No spaces allowed in new password!";
            } else {
                //Connect to the Database
                $serverName = "devweb2018.cis.strath.ac.uk";
                $userName = "cs312groupk";
                $password = "aeCh1ang9ahm";
                $dbname = $userName;
                $conn = new mysqli($serverName, $userName, $password, $dbname);
                if ($conn->connect_error) {
                    die("Failed to connect to database");
                }

                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $oldpassword = mysqli_real_escape_string($conn, $_POST['oldPass']);
                $newpassword = mysqli_real_escape_string($conn, $_POST['newPass']);
                $encPass = md5($oldpassword);

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
