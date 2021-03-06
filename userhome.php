<?php

    session_start();

    if(!isset($_SESSION['logged-in']) || $_SESSION['logged-in'] != true) {
        header("location:login.php");
    }
    if($_SESSION['user-type'] === 'owner') {
        header("location:ownerhome.php");
    }

    $id = $_SESSION['id'];
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];

    include("includes/config.php");
    include("includes/db.php");

    $bookings = mysqli_query($db, "SELECT b.*, r.roomNumber, r.building FROM bookings b JOIN rooms r ON (r.id = b.room_id) WHERE b.user_id = $id");

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

        <?php include("includes/header.php"); ?>

        <div class="container">

            <h2>My bookings</h2>

            <?php if ($bookings -> num_rows == 0) { ?>

                <div class="alert alert-primary" role="alert">
                    You haven't made any bookings yet.
                    <hr>
                    <a href="bookroom.php" class='btn btn-outline-primary'>Book a Room</a>
                </div>

            <?php } else { ?>

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Meeting Name</th>
                        <th>Time</th>
                        <th>Date</th>
                        <th>Institution</th>
                        <th>Room No.</th>
                        <th>Building</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while ($row = $bookings->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row["meeting_name"]; ?></td>
                            <td><?php echo $row["start_time"]." - ".$row["end_time"]; ?></td>
                            <td><?php echo $row["meeting_date"]; ?></td>
                            <td><?php echo $row["institution"]; ?></td>
                            <td><?php echo $row["roomNumber"]; ?></td>
                            <td><?php echo $row["building"]; ?></td>
                            <td><button type="button" class="btn btn-outline-danger" name="delete" data-target='#confirmDeletion<?php echo $row["booking_id"]; ?>' data-toggle="modal">Cancel</button></td>
                        </tr>
                        <div class="modal fade" role="dialog" id="confirmDeletion<?php echo $row["booking_id"]; ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title">Cancellation Confirmation</h6>
                                    </div>
                                    <div class="modal-body">
                                        <form action="removeBookings.php" method="post">
                                            <div class="form-group">
                                                Are you sure you want to cancel '<?php echo $row["meeting_name"]; ?>'?
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" name="bookingId" value="<?php echo $row['booking_id'];?>" />
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

        </div>

        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
