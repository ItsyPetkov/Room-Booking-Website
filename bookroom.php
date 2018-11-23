<?php
    /**
     * Created by IntelliJ IDEA.
     * User: gfb16165
     * Date: 18/11/2018
     * Time: 22:11
     */
    include("includes/config.php");
    include("includes/db.php");

    session_start();

    $id = $_SESSION['id'];
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
	
	$formStep = 1;
	$booked = false;
	$meeting_name = $start_time = $end_time = $date = $location = $capacity = $choice = $room = "";
	
	if(isset($_POST["submitStep1"])) {
		$meeting_name = mysqli_real_escape_string($db, $_POST["name"]);
        $start_time = mysqli_real_escape_string($db, $_POST["startTime"]);
        $end_time = mysqli_real_escape_string($db, $_POST["endTime"]);
		$date = mysqli_real_escape_string($db, $_POST["date"]);
		$location = mysqli_real_escape_string($db, $_POST["location"]);
		$capacity = mysqli_real_escape_string($db, $_POST["capacity"]);
		
		/* PHP form from step 1 validation */

        // query DB for matches
        $rooms_sql = mysqli_query($db, "SELECT * FROM rooms r LEFT JOIN bookings b ON (r.id = b.room_id) WHERE capacity >= '$capacity' AND institute = '$location'");

		$formStep = 2;
	}
	if(isset($_POST["submitStep2"])) {
		$meeting_name = mysqli_real_escape_string($db, $_POST["name"]);
        $start_time = mysqli_real_escape_string($db, $_POST["startTime"]);
        $end_time = mysqli_real_escape_string($db, $_POST["endTime"]);
		$date = mysqli_real_escape_string($db, $_POST["date"]);
		$location = mysqli_real_escape_string($db, $_POST["location"]);
		$capacity = mysqli_real_escape_string($db, $_POST["capacity"]);

        $room = mysqli_real_escape_string($db, $_POST["roomRadio"]);

        // query DB for matches
        $rooms_sql = mysqli_query($db, "SELECT * FROM rooms r LEFT JOIN bookings b ON (r.id = b.room_id) WHERE capacity >= '$capacity' AND institute = '$location' AND hoursAvailableS <= '$start_time' AND hoursAvailableE  >= '$start_time' AND hoursAvailableS <= '$end_time' AND hoursAvailableE  >= '$end_time' AND hoursAvailableE");

        // PHP form from step 2 validation
		// if valid --> show summary of details for confirmation
		$formStep = 3;
	}
	if(isset($_POST["submitStep3"])) {
		$meeting_name = mysqli_real_escape_string($db, $_POST["name"]);
        $start_time = mysqli_real_escape_string($db, $_POST["startTime"]);
        $end_time = mysqli_real_escape_string($db, $_POST["endTime"]);
		$date = mysqli_real_escape_string($db, $_POST["date"]);
		$location = mysqli_real_escape_string($db, $_POST["location"]);
		$capacity = mysqli_real_escape_string($db, $_POST["capacity"]);
		$room = mysqli_real_escape_string($db, $_POST["roomRadio"]);
		// update DB
		// send confirmation email with booking details
		$booked = true;
	}

 ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Book room</title>
		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!-- Clockpicker CSS -->
		<link rel="stylesheet" type="text/css" href="css/bootstrap-clockpicker.min.css">
		<!-- Custom CSS -->
		<link href="css/style.css" rel="stylesheet">
		<link href="css/bookroom.css" rel="stylesheet">
	</head>
	<body>
		<?php include("includes/header.php"); ?>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1 class="text-center">Book a room</h1>
				</div>
			</div>
			<?php if ($booked == true) { ?>
			<div class="alert alert-success" role="alert">
				<h4 class="alert-heading">Well done!</h4>
				<p>You successfully booked <?php echo $room." in ".$location." for ".$date." at ".$start_time ?>!</p>
				<hr>
				<p class="mb-0">We've just sent you an email to confirm the booking.</p>
			</div>
			<a class="btn btn-outline-secondary" href="#">View your bookings</a>
			<?php } else { ?>
			<div class="row">
				<ul class="nav justify-content-center step-wizard" style="width: 100%;">
					<?php if($formStep == 1) { ?>
					<li class="nav-item">
						<a id="defaultOpen" class="nav-link active formStep1" href="#" onclick="selectStep(event, 'formStep1')">1. Choose facilities</a>
					</li>
					<li class="nav-item">
						<a class="nav-link disabled formStep2" href="#">2. Select option</a>
					</li>
					<li class="nav-item">
						<a class="nav-link disabled formStep3" href="#">3. Confirm</a>
					</li>
					<?php } elseif ($formStep == 2) { ?>
					<li class="nav-item">
						<a class="nav-link formStep1" href="#" onclick="selectStep(event, 'formStep1')">1. Choose facilities</a>
					</li>
					<li class="nav-item">
						<a id="defaultOpen" class="nav-link active formStep2" href="#" onclick="selectStep(event, 'formStep2')">2. Select option</a>
					</li>
					<li class="nav-item">
						<a class="nav-link disabled formStep3" href="#">3. Confirm</a>
					</li>
					<?php } else { ?>
					<li class="nav-item">
						<a class="nav-link formStep1" href="#" onclick="selectStep(event, 'formStep1')">1. Choose facilities</a>
					</li>
					<li class="nav-item">
						<a class="nav-link formStep2" href="#" onclick="selectStep(event, 'formStep2')">2. Select option</a>
					</li>
					<li class="nav-item">
						<a id="defaultOpen" class="nav-link active formStep3" href="#" onclick="selectStep(event, 'formStep3')">3. Confirm</a>
					</li>
					<?php } ?>
				</ul>
			</div>
			<div id="formStep1" class="row tabcontent">
				<div class="col-md-12">
					<form class="needs-validation" novalidate action="" method="post">
						<div class="form-group row">
							<label for="name" class="col-sm-2 col-form-label">Meeting name</label>
							<div class="col-md-6 mb-3">
								<input type="text" class="form-control" name="name" id="name" placeholder="Enter name of meeting" autocomplete="off" value="<?php echo $meeting_name; ?>" required>
								<div class="invalid-feedback">
									Please, enter the name of the meeting!
								</div>
							</div>
						</div>
						
						<div class="form-group row">
							<label for="time" class="col-md-2 col-form-label">Start time</label>
							<div class="col-md-2 mb-3">
								<div class="input-group clockpicker">
									<input type="text" class="form-control" name="startTime" id="startTime" placeholder="00:00" pattern="(09|10|11|12|13|14|15|16):[0-5][0-9]" autocomplete="off" value="<?php echo $start_time; ?>" required>
									<div class="invalid-feedback">
										Please, enter the start time of the meeting (between 09:00 and 17:00)!
									</div>
								</div>
							</div>
                            <label for="time" class="col-md-1 offset-md-1 col-form-label">End time</label>
                            <div class="col-md-2 mb-3">
                                <div class="input-group clockpicker">
                                    <input type="text" class="form-control" name="endTime" id="time" placeholder="00:00" pattern="(09|10|11|12|13|14|15|16):[0-5][0-9]" autocomplete="off" value="<?php echo $end_time; ?>" required>
                                    <div class="invalid-feedback">
                                        Please, enter the end time of the meeting (between 09:00 and 17:00)!
                                    </div>
                                </div>
                            </div>
                            <label for="date" class="col-md-1 col-form-label">Date</label>
                            <div class="col-md-3 mb-3">
                                <div class="input-group">
                                    <input type="date" class="form-control" name="date" id="date" min="<?php echo date("Y-m-d"); ?>" max="<?php echo date('Y-m-d', strtotime(date("Y-m-d"). ' + 10 days')); ?>" value="<?php echo $date; ?>" required />
                                    <div class="invalid-feedback">
                                        Please, enter the date of the meeting!
                                    </div>
                                </div>
                            </div>
						</div>

						<div class="form-group row">
							<label for="location" class="col-sm-2 col-form-label">Location</label>
							<div class="col-md-6 mb-3">
								<select class="custom-select" id="location" name="location" required>
									<option value="">Choose the location</option>
                                    <?php $institutes = mysqli_query($db, "SELECT * FROM users WHERE institute !=  ''");
                                        while($row = $institutes->fetch_assoc()) { ?>
                                        <option value="<?php echo $row['institute']; ?>" <?php if($location == $row['institute']) echo 'selected="selected"'; ?>><?php echo $row['institute']; ?></option>
								    <?php } ?>
                                </select>
								<div class="invalid-feedback">
									Please, choose a location!
								</div>
							</div>
						</div>
						
						<div class="form-group row">
							<label for="capacity" class="col-sm-2 col-form-label">Room capacity</label>
							<div class="col-md-6 mb-3">
								<input type="number" class="form-control" name="capacity" id="capacity" placeholder="Enter room capacity" onkeypress="return isNumber(event)" min="1" max="500" value="<?php echo $capacity; ?>" required>
								<div class="invalid-feedback">
									Please, choose room capacity between 1 and 500!
								</div>
							</div>
						</div>
						
						<?php if($formStep == 1) { ?>
						<button type="button" class="btn btn-outline-secondary" disabled>Previous</button>
						<button type="submit" class="btn btn-outline-primary" name="submitStep1">Next</button>
						<?php } else { ?>
						<button type="button" class="btn btn-outline-secondary" disabled>Previous</button>
						<button type="button" class="btn btn-outline-primary" onclick="selectStep(event, 'formStep2')">Next</button>
						<?php } ?>
					</form>
				</div>
			</div>
			<div id="formStep2" class="row tabcontent">
				<div class="col-md-12">
					<form class="needs-validation" novalidate action="" method="post">
						<table class="table table-hover">
							<thead>
								<tr>
									<th scope="col">Room Number</th>
									<th scope="col">Building</th>
									<th scope="col">Institute</th>
									<th scope="col">Capacity</th>
                                    <th scope="col"></th>
								</tr>
							</thead>
							<tbody>
                                <?php if($formStep == 2 || $formStep == 3) {
                                    while($row = $rooms_sql->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?php echo $row['roomNumber'] ?></td>
                                            <td><?php echo $row['building'] ?></td>
                                            <td><?php echo $row['institute'] ?></td>
                                            <td><?php echo $row['capacity'] ?></td>
                                            <td>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="<?php echo 'room'.$row['id']; ?>" name="roomRadio" class="custom-control-input" value="<?php echo $row['id']; ?>" <?php if($room == $row['id']) echo 'checked'; ?> required>
                                                    <label class="custom-control-label" for="<?php echo 'room'.$row['id']; ?>">Select option</label>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php }
                                } ?>
							</tbody>
						</table>
						<input type="hidden" name="name" value="<?php echo $name; ?>">
						<input type="hidden" name="startTime" value="<?php echo $start_time; ?>">
                        <input type="hidden" name="endTime" value="<?php echo $end_time; ?>">
						<input type="hidden" name="date" value="<?php echo $date; ?>">
						<input type="hidden" name="location" value="<?php echo $location; ?>">
						<input type="hidden" name="capacity" value="<?php echo $capacity; ?>">

						<?php if($formStep == 2) { ?>
						<button type="button" class="btn btn-outline-secondary" onclick="selectStep(event, 'formStep1')">Previous</button>
						<button type="submit" class="btn btn-outline-primary" name="submitStep2">Next</button>
						<?php } elseif($formStep == 3) {?>
						<button type="button" class="btn btn-outline-secondary" onclick="selectStep(event, 'formStep1')">Previous</button>
						<button type="button" class="btn btn-outline-primary" onclick="selectStep(event, 'formStep3')">Next</button>
						<?php } ?>
					</form>
				</div>
			</div>
			<div id="formStep3" class="row tabcontent">
				<div class="col-md-12">
					<h2>Preview details and confirm booking</h2>
					<table class="table">
						<tbody>
							<tr>
								<th scope="row"><h6>Meeting name</h6></th>
								<td><?php echo $name; ?></td>
								<td></td>
								<td></td>
							</tr>
                            <tr>
                                <th scope="row"><h6>Start time</h6></th>
                                <td><?php echo $start_time; ?></td>
                                <th scope="row"><h6>End time</h6></th>
                                <td><?php echo $end_time; ?></td>
                            </tr>
							<tr>
								<th scope="row"><h6>Date</h6></th>
								<td><?php echo $date; ?></td>
								<th scope="row"><h6>Location</h6></th>
								<td><?php echo $location; ?></td>
							</tr>
							<tr>
								<th scope="row"><h6>Room</h6></th>
								<td><?php echo $room; ?></td>
                                <th scope="row"><h6>Room capacity</h6></th>
                                <td><?php echo $capacity; ?></td>
							</tr>
							
						</tbody>
					</table>
					<form class="needs-validation" novalidate action="" method="post">
						<input type="hidden" name="name" value="<?php echo $name; ?>">
                        <input type="hidden" name="startTime" value="<?php echo $start_time; ?>">
                        <input type="hidden" name="endTime" value="<?php echo $end_time; ?>">
						<input type="hidden" name="date" value="<?php echo $date; ?>">
						<input type="hidden" name="location" value="<?php echo $location; ?>">
						<input type="hidden" name="capacity" value="<?php echo $capacity; ?>">
						<input type="hidden" name="roomRadio" value="<?php echo $room; ?>">

						<button type="button" class="btn btn-outline-secondary" onclick="selectStep(event, 'formStep2')">Previous</button>
						<button type="submit" class="btn btn-outline-primary" name="submitStep3">Book</button>
					</form>
				</div>
			</div>
			<?php } ?>
		</div>
		
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