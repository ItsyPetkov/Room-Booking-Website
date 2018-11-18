<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home </title>



    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <?php include("includes/header.php");
    session_start();
    ?>
    <h1>Home lmao </h1>
<body>

<?php
/**
 * Created by IntelliJ IDEA.
 * User: rnb16141
 * Date: 14/11/2018
 * Time: 14:22
 */


$id = $_SESSION['id'];
$name = $_SESSION['name'];
$email = $_SESSION['email'];


include("includes/config.php");
include("includes/db.php");

echo"<h2> Current Booked Rooms</h2>";

if ($db->connect_error) die("Connection failed: " . $db->connect_error);

// Issue the query
$sql = "SELECT * FROM `bookings` WHERE `bookings`.`user_id` = '$id'";
$result = $db->query($sql);


if ($result->num_rows > 0) {


    echo "
    <table>
        <tr>
            <th></th>
            <th>Meeting Name</th>
            <th>Time</th>
            <th>Date</th>
            <th>Institution</th>
            <th>Room No.</th>
        </tr>
  ";
    // Filling the table
    while ($row = $result->fetch_assoc()) {

$sql2 = "SELECT * FROM `rooms` WHERE `id` = '".$row["room_id"]."'";
$result2 = $db->query($sql2);
        while ($row2 = $result2->fetch_assoc()) {
            $roomno = $row2["roomNumber"];
        }

        echo "<tr>\n";
        echo "<td></td>";
        echo "<td>" . $row["meeting_name"] . "</td>";
        echo "<td>" . $row["start_time"] . " - " . $row["end_time"] . "</td>";
        echo "<td>" . $row["institution"]  . "</td>";
        echo "<td>" . $roomno  . "</td>";

        echo "</tr>\n";
    }
    }
    else {
        echo "if youre seeing this the associated user ID doesnt have any current booking that match it, add some via phpmyadmin until theres more fucntionality lol, also if theres 3 errors up top it means that the session thing is confused. either manually set the varaibles in the code or navigate to this through the login/register pages with no institute";

}
    // Disconnect
    $db->close();

    ?>
</body>
