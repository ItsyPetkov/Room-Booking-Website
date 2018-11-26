<?php

    session_start();

    if(!isset($_SESSION['logged-in']) || $_SESSION['logged-in'] != true) {
        header("location:login.php");
    }
    if($_SESSION['user-type'] === 'normal') {
        header("location:userhome.php");
    }

    $id = $_SESSION['id'];
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $inst = $_SESSION['inst'];

    include("includes/config.php");
    include("includes/db.php");

    $rooms = mysqli_query($db, "SELECT * FROM rooms WHERE institute = '$inst'");

    $bookings = mysqli_query($db, "SELECT b.*, r.roomNumber, u.name FROM bookings b JOIN rooms r ON (r.id = b.room_id) JOIN users u ON (u.id = b.user_id) WHERE b.institution = '$inst'");

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width = device-width, initial-scale = 1">
        <title>Homepage</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    </head>
    <body>

        <?php include("includes/header.php");?>

        <div class="container">
            <h2>Rooms</h2>

            <?php if($rooms->num_rows == 0) { ?>

                <div class="alert alert-primary" role="alert">
                    Your institution hasn't added any rooms yet!
                    <hr>
                    <a href="addroom.php" class='btn btn-outline-primary'>Add Room</a>
                </div>

            <?php } else { ?>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Room Number</th>
                            <th>Building</th>
                            <th>Institute</th>
                            <th>Capacity</th>
                            <th>Hours Available</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php while ($row = $rooms->fetch_assoc()) { ?>

                        <tr>
                            <td><?php echo $row["roomNumber"]; ?></td>
                            <td><?php echo $row["building"]; ?></td>
                            <td><?php echo $row["institute"]; ?></td>
                            <td><?php echo $row["capacity"]; ?></td>
                            <td><?php echo $row["hoursAvailableS"]; ?>  - <?php echo $row["hoursAvailableE"]; ?></td>
                            <td><button type="button" class="btn btn-outline-danger" name="delete" data-target='#confirmDeletion<?php echo $row["id"]; ?>' data-toggle="modal">Delete</button></td
                        </tr>
                        <div class="modal fade" role="dialog" id="confirmDeletion<?php echo $row["id"]; ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title">Deletion Confirmation</h6>
                                    </div>
                                    <div class="modal-body">
                                        <form action="removeRooms.php" method="post">
                                            <div class="form-group">
                                                Are you sure you want to delete room <?php echo $row["roomNumber"]; ?> from building <?php echo $row["building"]; ?>?
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" name="roomId" value="<?php echo $row['id'];?>" />
                                                <button type="submit" name="delete" class="btn btn-outline-success">Yes</button>
                                                <button class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    </tbody>
                </table>

            <?php } ?>

            <hr>
            <h2>Bookings</h2>

            <?php if($bookings->num_rows == 0) { ?>

                <div class="alert alert-primary" role="alert">
                    No bookings have been made for your rooms yet!
                </div>

            <?php } else { ?>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Meeting Name</th>
                            <th>User</th>
                            <th>Room No.</th>
                            <th>Time</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php while ($row = $bookings->fetch_assoc()) { ?>

                        <tr>
                            <td><?php echo $row["meeting_name"]; ?></td>
                            <td><?php echo $row["name"]; ?></td>
                            <td><?php echo $row["roomNumber"]; ?></td>
                            <td><?php echo $row["start_time"]; ?> - <?php echo $row["end_time"]; ?></td>
                            <td><?php echo $row["meeting_date"]; ?></td>
                        </tr>

                    <?php } ?>

                    </tbody>
                </table>

            <?php } ?>

        </div>

        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

    </body>
</html>

}