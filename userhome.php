<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width = device-width, initial-scale = 1">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Homepage</title>

<?php
/**
 * Created by IntelliJ IDEA.
 * User: rnb16141
 * Date: 14/11/2018
 * Time: 14:22
 */


include("includes/config.php");
include("includes/db.php");
include("includes/header.php");

session_start();
if($_SESSION['user-type'] === 'owner')
{
    header("location:ownerhome.php");
}


$id = $_SESSION['id'];
$name = $_SESSION['name'];
$email = $_SESSION['email'];

$result = mysqli_query($db, "SELECT b.*, r.roomNumber FROM bookings b JOIN rooms r ON (r.id = b.room_id) WHERE b.user_id = '$id'");
?>

<body>

<div class="container">
    <?php if($result->num_rows == 0) { ?>
        <div class="alert alert-primary" role="alert">
            You haven't made any bookings yet.
            <form action = 'bookroom.php' method = 'post'>
                <button name ='book' class='btn btn-outline-primary' /> Book a Room!</button></form>
        </div>
    <?php } else { ?>
        <table class="table">
            <thead>
            <tr>
                <th>Meeting Name</th>
                <th>Time</th>
                <th>Date</th>
                <th>Institution</th>
                <th>Room No.</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row["meeting_name"]; ?></td>
                    <td><?php echo $row["start_time"]." - ".$row["end_time"]; ?></td>
                    <td><?php echo $row["meeting_date"]; ?></td>
                    <td><?php echo $row["institution"]; ?></td>
                    <td><?php echo $row["roomNumber"]; ?></td>
                    <form action = 'removeBooking.php' value = <?php echo $row["booking_id"]; ?> method = 'post'>
                    <td><button name ='remove' class='btn btn-outline-primary'  value=<?php echo $row["booking_id"]; ?>/> Remove Room</button></td></form>;

                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
