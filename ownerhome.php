<?php
/**
 * Created by IntelliJ IDEA.
 * User: rnb16141
 * Date: 14/11/2018
 * Time: 14:23
 */
session_start();

$name = $_SESSION['name'];
$email = $_SESSION['email'];
$inst = $_SESSION['inst'];


include("includes/config.php");
include("includes/db.php");
if ($db->connect_error) die("Connection failed: " . $db->connect_error);



// Issue the query
$sql = "SELECT * FROM `rooms` WHERE `institute` = '$inst'";
$result = $db->query($sql);

if ($result->num_rows > 0)
{ echo"
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
        echo "<td>" . $row["roomNumber"] . "</td>";
        echo "<td>" . $row["building"] . "</td>";
        echo "<td>" . $row["institute"] . "</td>";
        echo "<td>" . $row["capacity"] . "</td>";
        echo "<td>" . $row["hoursAvailableS"] . " - " . $row["hoursAvailableE"] . "</td>";

        echo "</tr>\n";
    }
    // Disconnect
    $db->close();

    echo" <a href=\"addroom.php\" class=\"button\">Add a Room</a>";
        }?>


