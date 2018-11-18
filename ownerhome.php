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
            <th>Room No.</th>
            <th>Building</th>
            <th>Institute</th>
            <th>Capacity</th>
            <th>Availability</th>
            <th>Description?</th>
        </tr>
  ";
    // Filling the table
    while ($row = $result->fetch_assoc()) {
        echo "<tr>\n";
        echo "<td></td>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["roomNumber"] . "</td>";
        echo "<td>" . $row["building"] . "</td>";
        echo "<td>" . $row["institute"] . "</td>";
        echo "<td>" . $row["capacity"] . "</td>";
        echo "<td>" . $row["hoursAvailableS"] . " - " . $row["hoursAvailableE"] . "</td>";
        echo "<form action = 'removeRooms.php' value = ".$row["id"]." method = 'post'>";
        echo "<td><button name ='remove'  value=" . $row["id"] . "/>Remove Room</button></td></form>";

        echo "</tr>\n";
    }
}
    else{
        echo "fuck aw here lads";
}
    // Disconnect
    $db->close();

        ?>

    <?php
    echo "<form action = 'addroom.php' method = 'post'>";
    echo "<button name ='add'/>Add Room</button></form>";
    ?>
</body>


