<!DOCTYPE html>
<html lang="en">
<head>
    <title>Confirm deletion</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
<body>
<div>
    <form method="post">
        <input type = "hidden" id = "deleteField" name = "deleteRow">
        <button onclick="remove()">Delete</button>
        <p id="prompt"></p>
        <script>
            function remove()
            {
                var userchoice;
                if (confirm("Are you sure you want to delete this room?"))
                {
                    userchoice = "delete"
                } else {
                    userchoice = null;
                }
                document.getElementById("deleteField").value = userchoice;
            }
        </script>
    </form>
        <?php
        // connect to mysql
        include("includes/config.php");
        include("includes/db.php");

        $delete = null;
        if (isset($_POST["deleteRow"]))
        {
            $delete = $_POST["deleteRow"];
        }

        // Will only delete row if "confirmed" is equal to the id of the row we want to delete
        if($delete != "no" && $delete != null)
        {
            // Issue the query
            $sql = "DELETE FROM `rooms` WHERE id = '$delete'";
            //mysqli_query($db, $sql);
            echo "If you see this then that means the confirmation works. Just need to uncomment the delete statement";
        }

        // Disconnect
        $db->close();
        ?>
</div>
</body>
</html>