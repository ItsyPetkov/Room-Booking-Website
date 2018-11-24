<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width = device-width, initial-scale = 1">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Homepage</title>

    <?php
    session_start();
    if($_SESSION['user-type'] === 'normal')
    {
        header("location:userhome.php");
    }

    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $inst = $_SESSION['inst'];
    include("includes/header.php");
    include("includes/config.php");
    include("includes/db.php");

    if ($db->connect_error) die("Connection failed: " . $db->connect_error);



    $result = mysqli_query($db, "SELECT * FROM rooms WHERE institute = '$inst'");

    $result2 = mysqli_query($db, "SELECT b.*, r.roomNumber FROM bookings b JOIN rooms r ON (r.id = b.room_id) WHERE b.institution = '$inst'");
    ?>
    <h1>Home lmao </h1>

<body>
<div class="container">
    <?php /**
     * Created by IntelliJ IDEA.
     * User: rnb16141
     * Date: 14/11/2018
     * Time: 14:23
     */?>

    <?php if($result->num_rows == 0) { ?>
        <div class="alert alert-primary" role="alert">
            Your institution hasn't added any rooms yet!
            <form action = 'addroom.php' method = 'post'>
                <button name ='add' class='btn btn-outline-primary' /> Add Room</button></form>
        </div>

    <?php } else { ?>

        <table class="table">
            <thead>
            <tr>
                <th>Room Number </th>
                <th>Building </th>
                <th>Institute </th>
                <th>Capacity </th>
                <th>Hours Available </th>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <form action="ownerhome.php" method="post">
                    <tr>
                        <td> <?php echo  $row["roomNumber"]?> </td>
                        <td><?php echo  $row["building"]?> </td>
                        <td> <?php echo  $row["institute"]?> </td>
                        <td><?php echo  $row["capacity"]?> </td>
                        <td><?php echo  $row["hoursAvailableS"]?>  - <?php echo $row["hoursAvailableE"]?> </td>
                        <?php $id = $row["id"]?>
                        <td><button class="btn btn-outline-danger" name="<?php echo $id;?>" data-dismiss="modal">Delete</button></td>
                        <?php
                        if(isset($_POST[$id]))
                        {
                            $sql = "DELETE FROM `rooms` WHERE `rooms`.`id` = '$id'";
                            mysqli_query($db, $sql);
                            header("Location: ownerhome.php");
                        }
                        ?>
<!--                        <input type = "hidden" id = "deleteField" name = "deleteRow">-->
<!--                        <td><button onclick="remove()">Delete</button></td>-->
<!--                        <script>-->
<!--                            function remove()-->
<!--                            {-->
<!--                                var userchoice;-->
<!--                                if (confirm("Are you sure you want to delete this room?"))-->
<!--                                {-->
<!--                                    userchoice = "delete"-->
<!--                                } else {-->
<!--                                    userchoice = null;-->
<!--                                }-->
<!--                                document.getElementById("deleteField").value = userchoice;-->
<!--                            }-->
<!--                        </script>-->
<!--                        --><?php
//
//                        $delete = null;
//                        if (isset($_POST["deleteRow"]))
//                        {
//                            $delete = $row["id"];
//                        }
//
//                        // Will only delete row if "confirmed" is equal to the id of the row we want to delete
//                        if($delete != "no" && $delete != null)
//                        {
//                            // Issue the query
//                            $sql = "DELETE FROM `rooms` WHERE id = '$delete'";
//                            //mysqli_query($db, $sql);
//                            echo "If you see this then that means the confirmation works. Just need to uncomment the delete statement";
//                        }
//                        ?>
                    </tr>
                </form>
            <?php } ?>
            </tbody>
        </table>
    <?php } ?>
    <div></div>
    <?php if($result2->num_rows == 0) { ?>
        <div class="alert alert-primary" role="alert">
            No bookings have been made for your rooms yet!
        </div>
    <?php } else { ?>
        <table class="table">
            <thead>
            <tr>
                <th>Meeting Name</th>
                <th>Time</th>
                <th>Date</th>
                <th>Room No.</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = $result2->fetch_assoc()) { ?>
                <tr>
                    <td> <?php echo $row["meeting_name"]?> </td>
                    <td><?php echo  $row["start_time"]?> - <?php echo $row["end_time"]?></td>
                    <td><?php echo  $row["meeting_date"]?> </td>
                    <td><?php echo   $row["roomNumber"]?> </td>

                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } ?>


</div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>


</body>
</html>
