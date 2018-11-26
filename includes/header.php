<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand" href="#">Book A Room</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">

            <?php if(strpos($_SERVER['REQUEST_URI'], "userhome.php")) { ?>
			    <li class="nav-item active">
			    	<a class="nav-link" href="#">My bookings <span class="sr-only">(current)</span></a>
			    </li>
                <li class="nav-item">
                    <a class="nav-link" href="bookroom.php">Book a room</a>
                </li>
            <?php } ?>

            <?php if(strpos($_SERVER['REQUEST_URI'], "bookroom.php")) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="userhome.php">My bookings</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Book a room <span class="sr-only">(current)</span></a>
                </li>
            <?php } ?>

            <?php if(strpos($_SERVER['REQUEST_URI'], "details.php") && $_SESSION["user-type"] == "normal") { ?>
                <li class="nav-item">
                    <a class="nav-link" href="userhome.php">My bookings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="bookroom.php">Book a room</a>
                </li>
            <?php } ?>

            <?php if(strpos($_SERVER['REQUEST_URI'], "details.php") && $_SESSION["user-type"] == "owner") { ?>
                <li class="nav-item">
                    <a class="nav-link" href="ownerhome.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="addroom.php">Add room</a>
                </li>
            <?php } ?>

            <?php if(strpos($_SERVER['REQUEST_URI'], "ownerhome.php")) { ?>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Dashboard <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="addroom.php">Add room</a>
                </li>
            <?php } ?>

            <?php if(strpos($_SERVER['REQUEST_URI'], "addroom.php")) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="ownerhome.php">Dashboard</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Add room <span class="sr-only">(current)</span></a>
                </li>
            <?php } ?>

		</ul>
		<span style="margin-right: 10px" class="navbar-text">
			Hi, <?php echo $_SESSION['name']; ?>
		</span>
        <a style="margin-right: 5px" class="btn btn-outline-info my-2 my-sm-0" href="details.php">Your Details</a>
		<a style="margin-right: 10px" class="btn btn-outline-secondary my-2 my-sm-0" href="logout.php">Log out</a>
	</div>
</nav>