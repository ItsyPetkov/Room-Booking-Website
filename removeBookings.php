<!DOCTYPE html>
<html lang="en">
<head>
    <title>Confirm deletion</title>
    <h1>Title</h1>
<body>
<div>
    Are you sure you want to delete this booking?
    <form method="post">
        <?php $chosenBooking = $_GET["remove-booking"]; ?>
        <td><button type="submit" name = "confirm" value = <?php echo $chosenBooking; ?>>Yes</button></td>
        <td><button type="submit" name = "confirm" value = no>No</button></td>

        <?php
        // connect to mysql
        include("includes/config.php");
        include("includes/db.php");

        if ($db->connect_error)
        {
            die("Connection failed : ".$db->connect_error); // Remove once working!!!
        }

        $confirmed = 0;
        if (isset($_POST["confirm"]))
        {
            $confirmed = $_POST["confirm"];
        }

        // Shouldn't work but it does ¯\_(ツ)_/¯
        // Will only delete row if "confirmed" is equal to the id of the row we want to delete
        if($confirmed != "no" && $confirmed != null)
        {
            // Issue the query
            $sql = "DELETE FROM `bookings` WHERE id = '$confirmed'";
            //mysqli_query($db, $sql);
            echo "If you see this then that means the confirmation works. Just need to uncomment the delete statement";
        }

        // Disconnect
        $db->close();

        //header("Location: https://devweb2018.cis.strath.ac.uk/~gxb16190/groupk/index.php");
        //exit();
        ?>
</div>
</body>
</html>