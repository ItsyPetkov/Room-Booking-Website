


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Room </title>
<h1>Add A Room Bitch </h1>
<body>
<div>
    <form enctype="multipart/form-data" action="addroom.php" method="post">
        <p>  Room Number:  <input type="string"  name="rnumber" value="<?php if(isset($_POST['rnumber'])) {echo $_POST['rnumber'];} ?>" required />  </p>
        <p>  Building  <input type="string"  name="building" value="<?php if(isset($_POST['building'])) {echo $_POST['building'];} ?>" required />  </p>
        //add institue from sessions???? if logged in as a owner rather than user get inst from db
        <p>  Institute  <input type="string"  name="inst" value="<?php if(isset($_POST['inst'])) {echo $_POST['inst'];} ?>" required />  </p>
        <p>  Capacity  <input type="int"  name="cap" value="<?php if(isset($_POST['cap'])) {echo $_POST['cap'];} ?>" required />  </p>
        <p>  Hours Available (From)  <input type="time"  name="from" value="<?php if(isset($_POST['from'])) {echo $_POST['from'];} ?>" required />  </p>
        <p>  Hours Available (To)  <input type="time"  name="to" value="<?php if(isset($_POST['to'])) {echo $_POST['to'];} ?>" required />  </p>

        <br><input type="submit" value="Submit" />
    </form>






    <?php
    if(!isset($_POST['rnumber']) || !isset($_POST['building']) || !isset($_POST['inst']) || !isset($_POST['cap']) || !isset($_POST['from']) || !isset($_POST['to']) ) {
        echo '<p>Please complete all fields!</p>';
    } else {


//info for adding to db
        $rnumber = $_POST['rnumber'];
        $building = $_POST['building'];
        $institue = $_POST['inst'];
        $capacity = $_POST['cap'];
        $hfrom = $_POST['from'];
        $hto = $_POST['to'];


//connect to the database
        $host = "devweb2018.cis.strath.ac.uk";
        $user = "cs312groupk";
        $password = "aeCh1ang9ahm";
        $dbname = "cs312groupk";
        $conn = new mysqli($host, $user, $password, $dbname);
        if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);//FIXME only show error during debugging


        $sql = "INSERT INTO `rooms` (`id`, `roomNumber`, `building`, `institute`, `capacity`, `hoursAvailableS`, `hoursAvailableE`) VALUES (NULL, '$rnumber', '$building', '$institue', '$capacity', '$hfrom', '$hto' )";

        echo "<p></p>";

        if ($conn->query($sql) === TRUE) {
            echo "Room " . $rnumber . " in " . $institue . " has been added!";
        }


        $conn->close();

    }
    ?>


</body>



</html>