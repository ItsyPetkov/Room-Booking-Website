<!DOCTYPE html>
<html lang="en">
<head>
    <title>Confirm deletion</title>
    <h1>Title</h1>
<body>
<div>
    Are you sure you want to delete this room?
    <form method="post">
        <?php $chosenBooking = $_POST["remove"]; ?>
        <td><button type="submit" name = "confirm" value = <?php echo $chosenBooking; ?>>Yes</button></td>
        <td><button type="submit" name = "confirm" value = no>No</button></td>

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

        $confirmed = 0;
        if (isset($_POST["confirm"]))
        {
            $confirmed = $_POST["confirm"];
        }

        // For some reason it doesn't enter into this loop when the page is first opened and idk why. Works as intended though
        // Will only delete row if "confirmed" is equal to the id of the row we want to delete
        if($confirmed != "no" && $confirmed != null)
        {
            // Issue the query
            //$sql = "DELETE FROM `rooms` WHERE id = '$confirmed'";
            echo "If you see this then that means the confirmation works. Just need to uncomment the delete statement";
        }

        // Disconnect
        $conn->close();

        //header("Location: https://devweb2018.cis.strath.ac.uk/~gxb16190/groupk/index.php");
        //exit();
        ?>
</div>
</body>
</html>