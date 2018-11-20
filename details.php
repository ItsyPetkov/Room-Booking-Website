<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <meta charset="UTF-8">
    <title>Account Details</title>
</head>
<body>
<?php include("includes/header.php"); ?>
    <form>
        <table>
            <tr><th></th><th></th><th></th></tr>
            <?php
            /**
             * Created by IntelliJ IDEA.
             * User: Hristo Petkov
             * Date: 11/20/2018
             * Time: 8:11 PM
             */

            include("includes/config.php");
            include("includes/db.php");
            $id = $_SESSION["id"];
            $sql2 = "SELECT * FROM `users` WHERE `id` = '$id'";
            $result2 = $db->query($sql2);
            while($row = $result2->fetch_assoc()){
                echo "<tr>";
                echo "<td><b>Account ID </b></td><td>".$row["id"]."</td><td>Edit Button here</td>";
                echo "</tr>\n";
                echo "<tr>";
                echo "<td><b>Username </b></td><td>".$row["name"]."</td><td>Edit Button here</td>";
                echo "</tr>\n";
                echo "<tr>";
                echo "<td><b>Email </b></td><td>".$row["email"]."</td><td>Edit Button here</td>";
                echo "</tr>\n";
                if($_SESSION['user-type'] === "owner")
                {
                    echo "<tr>";
                    echo "<td><b>Institute </b>".$row["institute"]."</td>";
                    echo "</tr>\n";
                }


//                echo "<td>".$size."</td>\n";
//                echo "<td>".$rowz["price"]."</td>\n";
//                echo "<td><input type='submit' value='More' name='$str'/></td>\n";
//                echo "<td><input type='submit' value='Order' name='$id'/></td>\n";
//                echo "</tr>\n";
            }
            echo "</table>";
            echo "<p>Want to change your passowrd? <a href=\"newPass.php\">Change here</a></p>"

            ?>
        </table>
    </form>
</body>
</html>
