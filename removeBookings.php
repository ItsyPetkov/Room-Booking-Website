<!DOCTYPE html>
<html lang="en">
<head>
    <title>Confirm deletion</title>
    <h1>Title</h1>
<body>
<div>
    Are you sure you want to delete this booking?
    <form method="post">
        <?php $chosenBooking = 5; ?>
        <td><button type="submit" name = "confirm" value = yes>Yes</button></td>
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

        $confirmed = $_POST["confirm"];
        if($confirmed === "yes")
        {
            // Issue the query
            //$sql = "DELETE * FROM `bookings` WHERE id = '$confirmed'";
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