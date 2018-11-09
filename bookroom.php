<?php 

	include("includes/config.php");
	include("includes/db.php");
	
	$formStep = 1;
	$booked = false;
	$name = $time = $date = $location = $capacity = $choice = $room = "";
	$extras = [];
	
	if(isset($_POST["submitStep1"])) {
		$name = mysqli_real_escape_string($db, $_POST["name"]);
		$time = mysqli_real_escape_string($db, $_POST["time"]);
		$date = mysqli_real_escape_string($db, $_POST["date"]);
		$location = mysqli_real_escape_string($db, $_POST["location"]);
		$capacity = mysqli_real_escape_string($db, $_POST["capacity"]);
		$extras = $_POST["extras"];
		
		// PHP form from step 1 validation
		// if valid --> query DB for matches
		$formStep = 2;
		// show best matches in step two
	}
	if(isset($_POST["submitStep2"])) {
		$name = mysqli_real_escape_string($db, $_POST["name"]);
		$time = mysqli_real_escape_string($db, $_POST["time"]);
		$date = mysqli_real_escape_string($db, $_POST["date"]);
		$location = mysqli_real_escape_string($db, $_POST["location"]);
		$capacity = mysqli_real_escape_string($db, $_POST["capacity"]);
		$extras = $_POST["extras"];
		
		$room = mysqli_real_escape_string($db, $_POST["roomRadio"]);
		// PHP form from step 2 validation
		// if valid --> show summary of details for confirmation
		$formStep = 3;
	}
	if(isset($_POST["submitStep3"])) {
		$name = mysqli_real_escape_string($db, $_POST["name"]);
		$time = mysqli_real_escape_string($db, $_POST["time"]);
		$date = mysqli_real_escape_string($db, $_POST["date"]);
		$location = mysqli_real_escape_string($db, $_POST["location"]);
		$capacity = mysqli_real_escape_string($db, $_POST["capacity"]);
		$extras = $_POST["extras"];
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
				<p>You successfully booked <?php echo $room." in ".$location." for ".$date." at ".$time ?>!</p>
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
								<input type="text" class="form-control" name="name" id="name" placeholder="Enter name of meeting" autocomplete="off" value="<?php echo $name; ?>" required>
								<div class="invalid-feedback">
									Please, enter the name of the meeting!
								</div>
							</div>
						</div>
						
						<div class="form-group row">
							<label for="time" class="col-md-2 col-form-label">Time range</label>
							<div class="col-md-4 mb-3">
								<div class="input-group clockpicker">
									<input type="text" class="form-control" name="time" id="time" placeholder="00:00" pattern="(09|10|11|12|13|14|15|16):[0-5][0-9]" autocomplete="off" value="<?php echo $time; ?>" required>
									<div class="invalid-feedback">
										Please, enter the time of the meeting (between 09:00 and 17:00)!
									</div>
								</div>
							</div>
							<label for="date" class="col-md-1 offset-md-1 col-form-label">Date</label>
							<div class="col-md-4 mb-3">
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
								<input type="number" class="form-control" name="capacity" id="capacity" placeholder="Enter room capacity" onkeypress="return isNumber(event)" min="1" max="500" value="<?php echo $capacity; ?>" required>
								<div class="invalid-feedback">
									Please, choose room capacity between 1 and 500!
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="row">
								<label class="col-sm-2 col-form-label">Extras</label>
								<div class="col-md-6 mb-3">
									<div class="custom-control custom-checkbox mb-3">
										<input type="checkbox" class="custom-control-input" name="extras[]" id="multimedia" value="multimedia" <?php if(isset($_POST['extras'])){if(in_array('multimedia', $_POST['extras'])) echo 'checked';} ?>>
										<label class="custom-control-label" for="multimedia">Multimedia</label>
									</div>
									<div class="custom-control custom-checkbox mb-3">
										<input type="checkbox" class="custom-control-input" name="extras[]" id="tv" value="tv" <?php if(isset($_POST['extras'])){if(in_array('tv', $_POST['extras'])) echo 'checked';} ?>>
										<label class="custom-control-label" for="tv">TV</label>
									</div>
									<div class="custom-control custom-checkbox mb-3">
										<input type="checkbox" class="custom-control-input" name="extras[]" id="camera" value="camera" <?php if(isset($_POST['extras'])){if(in_array('camera', $_POST['extras'])) echo 'checked';} ?>>
										<label class="custom-control-label" for="camera">Camera</label>
									</div>
								</div>
							</div>
						</div>
						
						<?php if($formStep == 1) { ?>
						<button type="button" class="btn btn-outline-secondary" disabled>Previous</button>
						<button type="submit" class="btn btn-outline-primary" name="submitStep1">Next</button>
						<?php } else { ?>
						<button type="button" class="btn btn-outline-secondary" disabled>Previous</button>
						<button type="button" class="btn btn-outline-primary" onclick="selectStep(event, 'formStep2')">Next</a>
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
									<th scope="col">#</th>
									<th scope="col">First</th>
									<th scope="col">Last</th>
									<th scope="col">Handle</th>
									<th scope="col"></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th scope="row">1</th>
									<td>Mark</td>
									<td>Otto</td>
									<td>@mdo</td>
									<td>
										<div class="custom-control custom-radio">
											<input type="radio" id="roomRadio1" name="roomRadio" class="custom-control-input" value="room1" <?php if($room == "room1") echo 'checked'; ?> required>
											<label class="custom-control-label" for="roomRadio1">Select option 1</label>
										</div>
									</td>
								</tr>
								<tr>
									<th scope="row">2</th>
									<td>Jacob</td>
									<td>Thornton</td>
									<td>@fat</td>
									<td>
										<div class="custom-control custom-radio">
											<input type="radio" id="roomRadio2" name="roomRadio" class="custom-control-input" value="room2" <?php if($room == 'room2') echo 'checked'; ?> required>
											<label class="custom-control-label" for="roomRadio2">Select option 2</label>
										</div>
									</td>
								</tr>
								<tr>
									<th scope="row">3</th>
									<td colspan="2">Larry the Bird</td>
									<td>@twitter</td>
									<td>
										<div class="custom-control custom-radio">
											<input type="radio" id="roomRadio3" name="roomRadio" class="custom-control-input" value="room3" <?php if($room == "room3") echo 'checked'; ?> required>
											<label class="custom-control-label" for="roomRadio3">Select option 3</label>
											
										</div>
									</td>
								</tr>
							</tbody>
						</table>
						<input type="hidden" name="name" value="<?php echo $name; ?>">
						<input type="hidden" name="time" value="<?php echo $time; ?>">
						<input type="hidden" name="date" value="<?php echo $date; ?>">
						<input type="hidden" name="location" value="<?php echo $location; ?>">
						<input type="hidden" name="capacity" value="<?php echo $capacity; ?>">
						<?php foreach($extras as $extra) {
							echo '<input type="hidden" name="extras[]" value="'. $extra. '">';
						} ?>
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
								<th scope="row"><h6>Date</h6></th>
								<td><?php echo $date; ?></td>
								<th scope="row"><h6>Location</h6></th>
								<td><?php echo $location; ?></td>
							</tr>
							<tr>
								<th scope="row"><h6>Time of meeting</h6></th>
								<td><?php echo $time; ?></td>
								<th scope="row"><h6>Room</h6></th>
								<td><?php echo $room; ?></td>
							</tr>
							<tr>
								<th scope="row"><h6>Room capacity</h6></th>
								<td><?php echo $capacity; ?></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<th scope="row"><h6>Extras</h6></th>
								<td>
									<ul><?php foreach($extras as $extra) { echo "<li>".$extra."</li>"; } ?></ul>
								</td>
							</tr>
							
						</tbody>
					</table>
					<form class="needs-validation" novalidate action="" method="post">
						<input type="hidden" name="name" value="<?php echo $name; ?>">
						<input type="hidden" name="time" value="<?php echo $time; ?>">
						<input type="hidden" name="date" value="<?php echo $date; ?>">
						<input type="hidden" name="location" value="<?php echo $location; ?>">
						<input type="hidden" name="capacity" value="<?php echo $capacity; ?>">
						<?php foreach($extras as $extra) {
							echo '<input type="hidden" name="extras[]" value="'. $extra. '">';
						} ?>
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