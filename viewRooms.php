<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Rooms</title>
    <h1>Excuse the shitty styling; css will make it 👌</h1>
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
    $conn = new mysqli($host, $user, $pass, $dbname);

    if ($conn->connect_error)
    {
        die("Connection failed : ".$conn->connect_error); // Remove once working!!!
    }

    // Issue the query
    $sql = "SELECT * FROM `rooms` WHERE 1";
    $result = $conn->query($sql);

    if (!$result)
    {
        die("Query failed".$conn->error); // Remove once working!!!
    }

    // Handling the result
    if ($result->num_rows > 0)
    { ?>
    <table>
        <tr>
            <th></th>
            <th>Room Number</th>
            <th>Building</th>
            <th>Institute</th>
            <th>Capacity</th>
            <th>Availability</th>
            <th>Description</th>
        </tr>
        <?php
        // Filling the table
        while ($row = $result->fetch_assoc()) {
            echo "<tr>\n";
            echo "<td>Picture here?</td>";
            echo "<td>" . $row["roomNumber"] . "</td>";
            echo "<td>" . $row["building"] . "</td>";
            echo "<td>" . $row["institute"] . "</td>";
            echo "<td>" . $row["capacity"] . "</td>";
            echo "<td>" . $row["hoursAvailableS"] . " - " . $row["hoursAvailableE"] . "</td>";
            echo "<td>Small description here?</td>";
            echo "</tr>\n";
        }
        // Disconnect
        $conn->close();
        } ?>
    </table>
<br><div>A more stylish idea:</div><br>
    ******************** Building: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Availability:<br>
    ******************** <i>Building name here</i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Availability here<br>
    ******************** <br>
    *****Picture here***** Institute &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Capacity:<br>
    ******************** <i>Institute here</i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Capacity here<br>
    ********************<br>
    ******************** Room number:<br>
    ******************** <i>Room number here</i><br></div>

<br><div></div><br>
******************** Building: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Availability:<br>
******************** <i>Building name here</i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Availability here<br>
******************** <br>
*****Picture here***** Institute &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Capacity:<br>
******************** <i>Institute here</i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Capacity here<br>
********************<br>
******************** Room number:<br>
******************** <i>Room number here</i><br></div>
<br></br>etc...
</body>
</html>