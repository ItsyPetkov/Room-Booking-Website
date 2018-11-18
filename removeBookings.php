<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Rooms</title>
    <h1>Title</h1>
<body>
<div>
    Are you sure you want to delete this booking?
    <form action="deletingBooking.php" method="post">
        <?php $chosenRoom = $_POST["id"]; ?>
        <td><button type=\"submit\" name = \"confirm\" value = <?php echo $chosenBooking; ?>>Yes</button></td>
        <td><button type=\"submit\" name = \"confirm\" value = no>No</button></td>
</div>
</body>
</html>