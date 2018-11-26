<?php

    include("includes/config.php");
    include("includes/db.php");

    if (isset($_POST["delete"]))
    {
        $booking_id = $_POST["bookingId"];
    }

    $sql = "DELETE FROM bookings WHERE booking_id = '$booking_id'";
    mysqli_query($db, $sql);

    header("location:userhome.php");

?>