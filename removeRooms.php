<?php

    include("includes/config.php");
    include("includes/db.php");

    if (isset($_POST["delete"]))
    {
        $room_id = $_POST["roomId"];
    }

    $sql = "DELETE FROM rooms WHERE id = '$room_id'";
    mysqli_query($db, $sql);

    header("location:ownerhome.php");

?>