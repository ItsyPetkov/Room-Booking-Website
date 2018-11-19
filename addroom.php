<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Room </title>
    <!-- Bootstrap core CSS -->
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Clockpicker CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap-clockpicker.min.css">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <?php
    session_start();
    include("includes/header.php");?>
    <h1>Add A Room Bitch </h1>
<body>
<div>
    <form class="needs-validation" novalidate enctype="multipart/form-data" action="addroom.php" method="post">
        <div class="form-group row">
            <label for="num" class="col-sm-2 col-form-label">Room number:</label>
            <div class="col-md-6 mb-3">
                <input type="text" class="form-control" name="num" id="num" placeholder="Enter room number." autocomplete="off" required>
                <div class="invalid-feedback">
                    Please include a room number.
                </div>
            </div>
        </div>

        get buildings from database!!
        <div class="form-group row">
            <label for="location" class="col-sm-2 col-form-label">Location</label>
            <div class="col-md-6 mb-3">
                <select class="custom-select" id="location" name="location" required>
                    <option value="">Choose the location</option>
                    <option value="building1" <?php if($location == "building1") echo 'selected="selected"'; ?>>buildingOne</option>
                    <option value="building2" <?php if($location == "building2") echo 'selected="selected"'; ?>>buildingTwo</option>
                    <option value="building3" <?php if($location == "building3") echo 'selected="selected"'; ?>>buildingThree</option>
                </select>
                <div class="invalid-feedback">
                    Please, choose a location!
                </div>
            </div>
        </div>



        <div class="form-group row">
            <label for="capacity" class="col-sm-2 col-form-label">Room capacity</label>
            <div class="col-md-6 mb-3">
                <input type="number" class="form-control" name="capacity" id="capacity" placeholder="Enter room capacity" onkeypress="return isNumber(event)" min="1" max="500" value="<?php if(isset($_POST['capacity'])) echo $_POST['capacity']; ?>" required>
                <div class="invalid-feedback">
                    Please, choose room capacity between 1 and 500!
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="timestart" class="col-md-2 col-form-label">Time range start</label>
            <div class="col-md-4 mb-3">
                <div class="input-group clockpicker">
                    <input type="text" class="form-control" name="timestart" id="timestart" placeholder="00:00" pattern="(09|10|11|12|13|14|15|16):[0-5][0-9]" autocomplete="off" value="<?php if(isset($_POST['timestart'])) echo $_POST['timestart']; ?>" required>
                    <div class="invalid-feedback">
                        Please, enter the time of the meeting (between 09:00 and 17:00)!
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="timeend" class="col-md-2 col-form-label">Time range end</label>
            <div class="col-md-4 mb-3">
                <div class="input-group clockpicker">
                    <input type="text" class="form-control" name="timeend" id="timeend" placeholder="00:00" pattern="(09|10|11|12|13|14|15|16):[0-5][0-9]" autocomplete="off" value="<?php if(isset($_POST['timeend'])) echo $_POST['timeend']; ?>" required>
                    <div class="invalid-feedback">
                        Please, enter the time of the meeting (between 09:00 and 17:00)!
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-outline-primary" name="submitStep2">Submit</button>
    </form>
    <?php
    //info for adding to db
    $rnumber = isset($_POST["num"])? $_POST["num"]: "";
    $building = isset($_POST["location"])? $_POST["location"]: "";
    $institue = $_SESSION['inst'];
    $capacity = isset($_POST["capacity"])? $_POST["capacity"]: "";
    $hfrom = isset($_POST["timestart"])? $_POST["timestart"]: "";
    $hto = isset($_POST["timeend"])? $_POST["timeend"]: "";


    //connect to the database
    include("includes/config.php");
    include("includes/db.php");
    if ($db->connect_error) die("Connection failed: " . $db->connect_error);//FIXME only show error during debugging


    $sql = "INSERT INTO `rooms` (`id`, `roomNumber`, `building`, `institute`, `capacity`, `hoursAvailableS`, `hoursAvailableE`) VALUES (NULL, '$rnumber', '$building', '$institue', '$capacity', '$hfrom', '$hto' )";

    echo "<p></p>";

    if ($db->query($sql) === TRUE) {
        echo "Room " . $rnumber . " in " . $institue . " has been added!";
    }

    $db->close();
    ?>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-clockpicker.min.js"></script>

    <script>
        $('.clockpicker').clockpicker({
            donetext: 'Done'
        });
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