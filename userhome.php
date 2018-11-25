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
    /**
     * Created by IntelliJ IDEA.
     * User: rnb16141
     * Date: 14/11/2018
     * Time: 14:22
     */

    session_start();
    if($_SESSION['user-type'] === 'owner')
    {
        header("location:ownerhome.php");
    }


    $id = $_SESSION['id'];
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];

    include("includes/config.php");
    include("includes/db.php");
    include("includes/header.php");

    $result = mysqli_query($db, "SELECT b.*, r.roomNumber FROM bookings b JOIN rooms r ON (r.id = b.room_id) WHERE b.user_id = $id");
    ?>
    <br>
    <br>

<body>

<div class="container">
    <?php if($result->num_rows == 0) { ?>
        <div class="alert alert-primary" role="alert">
            You haven't made any bookings yet.
            <form action = 'bookroom.php' method = 'post'>
                <button name ='book' class='btn btn-outline-primary' /> Book a Room!</button></form>
        </div>
    <?php } else { echo "rows = ". $result->num_rows; echo "id = ".$id; ?>

        <table class="table">
            <thead>
            <tr>
                <th>Meeting Name</th>
                <th>Time</th>
                <th>Date</th>
                <th>Institution</th>
                <th>Room No.</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <form action="userhome.php" method="post">
                    <tr>
                        <td><?php echo $row["meeting_name"]; ?></td>
                        <td><?php echo $row["start_time"]." - ".$row["end_time"]; ?></td>
                        <td><?php echo $row["meeting_date"]; ?></td>
                        <td><?php echo $row["institution"]; ?></td>
                        <td><?php echo $row["roomNumber"]; ?></td>
                        <?php $bid = $row["booking_id"]?>
                        <td><button type="button" class="btn btn-outline-danger" name="delete" data-target='#confirmDeletion' data-toggle="modal">Delete</button></td>

                        <div class="modal fade" role="dialog" id="confirmDeletion" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title">Deletion Confirmation</h6>
                                    </div>
                                    <div class="modal-body">
                                        <form action="ownerhome.php" method="post">
                                            <div class="form-group">
                                                Are you sure you want to delete this?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" name="<?php echo $bid;?>" class="btn btn-outline-success">Yes</button>
                                                <button class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if(isset($_POST[$bid]))
                        {
                            $sql = "DELETE FROM `bookings` WHERE `bookings`.`booking_id` = '$bid'";
                            mysqli_query($db, $sql);
                            header("Location: userhome.php");
                        }
                        ?>

                        <!--                    <input type = "hidden" id = "deleteField" name = "deleteRow">-->
                        <!--                    <td><button onclick="remove()">Delete</button></td>-->
                        <!--                    <script>-->
                        <!--                        function remove()-->
                        <!--                        {-->
                        <!--                            var userchoice;-->
                        <!--                            if (confirm("Are you sure you want to delete this room?"))-->
                        <!--                            {-->
                        <!--                                userchoice = "delete"-->
                        <!--                            } else {-->
                        <!--                                userchoice = null;-->
                        <!--                            }-->
                        <!--                            document.getElementById("deleteField").value = userchoice;-->
                        <!--                        }-->
                        <!--                    </script>-->
                        <!--                    --><?php
                        //
                        //                    $delete = null;
                        //                    if (isset($_POST["deleteRow"]))
                        //                    {
                        //                        $delete = $_POST["deleteRow"];
                        //                    }
                        //
                        //                    // Will only delete row if "confirmed" is equal to the id of the row we want to delete
                        //                    if($delete != "no" && $delete != null)
                        //                    {
                        //                        // Issue the query
                        //                        $sql = "DELETE FROM `bookings` WHERE id = '$delete'";
                        //                        //mysqli_query($db, $sql);
                        //                        echo "If you see this then that means the confirmation works. Just need to uncomment the delete statement";
                        //                    }
                        //                    ?>
                    </tr>
                </form>
            <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
