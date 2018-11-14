<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Rooms</title>
    <h1>Heading here</h1>
    <style>
        table, th, td {
            border: 1px solid black;
        }
    </style>
<body>
<div>
    <?php
    // connect to mysql
    $host = "devweb2018.cis.strath.ac.uk";
    $user = "cs312groupk";
    $pass = "aeCh1ang9ahm";
    $dbname = "cs312groupk";
    $db = new mysqli($host, $user, $pass, $dbname);

    if ($db->connect_error)
    {
        die("Connection failed : ".$db->connect_error); // Remove once working!!!
    }

    // Issue the query
    $user = $_POST["user"];
    $sql = "SELECT * FROM `bookings` WHERE 'user_id' = $user";
    //$sql = "SELECT * FROM `bookings` WHERE 1";
    $result = $db->query($sql);

    if (!$result)
    {
        die("Query failed".$db->error); // Remove once working!!!
    }

    // Handling the result
    if ($result->num_rows > 0)
    { ?>
    <table>
        <tr>
            <th>Room Number</th>
            <th>Institute</th>
            <th>Purpose</th>
            <th>Time booked</th>
            <th>Date booked</th>
        </tr>
        <?php
        // Filling the table
        while ($row = $result->fetch_assoc()) {
            echo "<tr>\n";
            echo "<td>" . $row["room_id"] . "</td>";
            echo "<td>" . $row["institution"] . "</td>";
            echo "<td>" . $row["meeting_name"] . "</td>";
            echo "<td>" . $row["start_time"] . " - " . $row["end_time"] . "</td>";
            echo "<td>" . $row["meeting_date"] . "</td>";
            echo "</tr>\n";
        }
        // Disconnect
        $db->close();
        } ?>
    </table>
</body>
</html>