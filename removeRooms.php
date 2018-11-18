<!DOCTYPE html>
<html lang="en">
<head>
    <title>Confirm deletion</title>
    <h1>Title</h1>
<body>
<div>
  Are you sure you want to delete this room?
    <form action="deletingRoom.php" method="post">
        <?php $chosenRoom = $_POST["id"]; ?>
        <td><button type=\"submit\" name = \"confirm\" value = <?php echo $chosenRoom; ?>>Yes</button></td>
        <td><button type=\"submit\" name = \"confirm\" value = no>No</button></td>
</div>
</body>
</html>
