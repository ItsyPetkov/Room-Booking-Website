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
    session_start();
    if($_SESSION['user-type'] === 'normal')
    {
        header("location:userhome.php");
    }
    include("includes/header.php");
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $inst = $_SESSION['inst'];

    include("includes/config.php");
    include("includes/db.php");

    if ($db->connect_error) die("Connection failed: " . $db->connect_error);



    $result = mysqli_query($db, "SELECT * FROM rooms WHERE institute = '$inst'");

    $result2 = mysqli_query($db, "SELECT b.*, r.roomNumber FROM bookings b JOIN rooms r ON (r.id = b.room_id) WHERE b.institution = '$inst'");
    ?>
    <h1>Home lmao </h1>

<body>
<div class="container">
<?php /**
 * Created by IntelliJ IDEA.
 * User: rnb16141
 * Date: 14/11/2018
 * Time: 14:23
 */?>

 <?php if($result->num_rows == 0) { ?>
    <div class="alert alert-primary" role="alert">
        Your institution hasn't added any rooms yet!
        <form action = 'addroom.php' method = 'post'>
            <button name ='add' class='btn btn-outline-primary' /> Add Room</button></form>
    </div>

 <?php } else { ?>

    <table class="table">
            <thead>
            <tr>
                <th>Room Number </th>
                <th>Building </th>
                <th>Institute </th>
                <th>Capacity </th>
                <th>Hours Available </th>
            </tr>
            </thead>
             <tbody>
     <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
        <td> <?php echo  $row["roomNumber"]?> </td>
        <td><?php echo  $row["building"]?> </td>
        <td> <?php echo  $row["institute"]?> </td>
        <td><?php echo  $row["capacity"]?> </td>
        <td><?php echo  $row["hoursAvailableS"]?>  - <?php echo $row["hoursAvailableE"]?> </td>
       <form action = 'removeBooking.php' value = <?php $row["id"]?> method = 'post'>
        <td><button name ='remove' class='btn btn-outline-primary'  value=<?php echo $row["id"]; ?>/> Remove Room</button></td></form>";

        </tr>
     <?php } ?>
     </tbody>
    </table>
 <?php } ?>
<div></div>
<?php if($result2->num_rows == 0) { ?>
    <div class="alert alert-primary" role="alert">
        No bookings have been made for your rooms yet!
    </div>
<?php } else { ?>
    <table class="table">
        <thead>
        <tr>
            <th>Meeting Name</th>
            <th>Time</th>
            <th>Date</th>
            <th>Room No.</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $result2->fetch_assoc()) { ?>
            <tr>
                <td> <?php echo $row["meeting_name"]?> </td>
                <td><?php echo  $row["start_time"]?> - <?php echo $row["end_time"]?></td>
                <td><?php echo  $row["meeting_date"]?> </td>
                <td><?php echo   $row["roomNumber"]?> </td>

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
