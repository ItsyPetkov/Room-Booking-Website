<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home </title>



    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <?php
    session_start();
    if($_SESSION['user-type'] === 'normal')
    {
        header("location:userhome.php");
    }
    include("includes/header.php");
    ?>
    <h1>Home lmao </h1>
<body>
<?php
/**
 * Created by IntelliJ IDEA.
 * User: rnb16141
 * Date: 14/11/2018
 * Time: 14:23
 */


$name = $_SESSION['name'];
$email = $_SESSION['email'];
$inst = $_SESSION['inst'];


include("includes/config.php");
include("includes/db.php");


if ($db->connect_error) die("Connection failed: " . $db->connect_error);



// Issue the query
$sql = "SELECT * FROM `rooms` WHERE `institute` = '$inst'";
$result = $db->query($sql);


if ($result->num_rows > 0) {
    echo "
    <table>
        <tr>
            <th></th>
            <th>Room Number </th>
            <th>Building </th>
            <th>Institute </th>
            <th>Capacity </th>
            <th>Hours Available </th>
        </tr>
  ";
    // Filling the table
    while ($row = $result->fetch_assoc()) {
        echo "<tr>\n";
        echo "<td></td>";
        echo "<td>" . $row["roomNumber"] . "</td>";
        echo "<td>" . $row["building"] . "</td>";
        echo "<td>" . $row["institute"] . "</td>";
        echo "<td>" . $row["capacity"] . "</td>";
        echo "<td>" . $row["hoursAvailableS"] . " - " . $row["hoursAvailableE"] . "</td>";
        echo "<form action = 'removeBooking.php' value =" . $row["id"]. " method = 'post'>";
        echo "<td><button name ='remove' class='btn btn-outline-primary'  value=". $row["id"] . "/> Remove Room</button></td></form>";



        echo "</tr>\n";
    }
}
else{
    echo "You have no rooms currently added by your institution!";
}

echo "<form action = 'addroom.php' method = 'post'>";
echo "<td><button name ='add' class='btn btn-outline-primary' /> Add Room</button></td></form>";

//$sql2 = "SELECT bookings.*, rooms.roomNumber FROM `bookings` JOIN `rooms` WHERE `rooms.institution` = '$inst'";
$sql2 = "SELECT bookings.*, rooms. FROM `bookings` JOIN `rooms` ON (bookings.room_id = rooms.id)  WHERE `bookings.institute` = '$inst' AND `rooms.institution` = '$inst'";
$result2 = $db->query($sql2);

if ($result2->num_rows > 0) {
    echo "
    <table>
        <tr>
            <th></th>
            <th>Meeting Name</th>
            <th>Time</th>
            <th>Date</th>
            <th>Room No.</th>
        </tr>
  ";
    // Filling the table
    while ($row = $result2->fetch_assoc()) {
        echo "<tr>\n";
        echo "<td></td>";
        echo "<td>" . $row["meeting_name"] . "</td>";
        echo "<td>" . $row["start_time"]." - ".$row["end_time"]. "</td>";
        echo "<td>" . $row["meeting_date"] . "</td>";
        echo "<td>" . $row["roomNumber"] . "</td>";

        echo "</tr>\n";
    }
}
else{
    echo "No bookings have been made for your rooms yet!";
}

// Disconnect
$db->close();

?>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>


</body>
</html>


