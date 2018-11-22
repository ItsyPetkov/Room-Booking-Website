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
<div class="container">
    <form>
        <table class="table table-hover">
            <tr class="active"><th></th><th></th><th></th></tr>
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
                echo "<td><b>Account ID </b></td><td>".$row["id"]."</td><td>Can't edit this, Sorry!</td>";
                echo "</tr>\n";
                echo "<tr>";
                echo "<td><b>Username </b></td><td>".$row["name"]."</td><td><button type='button' class='btn btn-link' data-target='#editNamePage'  data-toggle='modal'>Edit</button></td>";
                echo "</tr>\n";
                echo "<tr>";
                echo "<td><b>Email </b></td><td>".$row["email"]."</td><td><button type='button' class='btn btn-link' data-target='#editEmailPage'  data-toggle='modal'>Edit</button></td>";
                echo "</tr>\n";
                if($_SESSION['user-type'] === "owner")
                {
                    echo "<tr>";
                    echo "<td><b>Institute </b>".$row["institute"]."</td><td><button type='button' class='btn btn-link' data-target='#editInstitutionPage'  data-toggle='modal'>Edit</button></td>";
                    echo "</tr>\n";
                }


//                echo "<td>".$size."</td>\n";
//                echo "<td>".$rowz["price"]."</td>\n";
//                echo "<td><input type='submit' value='More' name='$str'/></td>\n";
//                echo "<td><input type='submit' value='Order' name='$id'/></td>\n";
//                echo "</tr>\n";
            }
            echo "</table>";
            echo "<p>Want to change your password? <a href=\"newPass.php\">Change here</a></p>"

            ?>
        </table>
    </form>
    <div class="modal fade" role="dialog" id="editNamePage" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Edit Details</h6>
                </div>
                <div class="modal-body">
                    <form action="details.php" method="post">
                        <div class="form-group">
                            Email: <input type="text" class="form-control" name="newname" placeholder="Enter new username"/>
                        </div>
                        <div class="form-group">
                            Confirm Email: <input type="text" class="form-control" name="conname" placeholder="Confirm your username"/>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="editname" class="btn btn-outline-primary" >Edit</button>
                            <button class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <div class="modal fade" role="dialog" id="editEmailPage" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">Edit Details</h6>
                    </div>
                    <div class="modal-body">
                        <form action="details.php" method="post">
                            <div class="form-group">
                                New Email: <input type="text" class="form-control" name="newmail" placeholder="Enter new email"/>
                            </div>
                            <div class="form-group">
                                Confirm Email: <input type="text" class="form-control" name="confmail" placeholder="Confirm your email"/>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="editemail" class="btn btn-outline-primary">Edit</button>
                                <button class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" role="dialog" id="editInstitutionPage" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">Edit Details</h6>
                    </div>
                    <div class="modal-body">
                        <form action="details.php" method="post">
                            <div class="form-group">
                                New Institution: <input type="text" class="form-control" name="newInstitution" placeholder="Enter new Institution"/>
                            </div>
                            <div class="form-group">
                                Confirm Institution: <input type="text" class="form-control" name="confInstitution" placeholder="Confirm your Institution"/>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="editInstitution" class="btn btn-outline-primary">Edit</button>
                                <button class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <div>
    <?php
        if(isset($_POST['editname']))
        {
            $newName = isset($_POST["newname"])? mysqli_real_escape_string($db, $_POST["newname"]): "";
            $confName = isset($_POST["conname"])? mysqli_real_escape_string($db, $_POST["conname"]): "";

            if($newName === $confName){
                $sql = "UPDATE `cs312groupk`.`users` SET `name` = '$confName' WHERE `id` = '$id'";
                $result = $db->query($sql);
                if($result){
                    echo "Name changed successfully";
                }else{
                    echo "Change failed";
                }
            }else{
                echo "Names don't match, please try again";
            }
        }

        elseif(isset($_POST['editemail'])){

            $newEmail = isset($_POST["newmail"])? mysqli_real_escape_string($db, $_POST["newmail"]): "";
            $confEmail = isset($_POST["confmail"])? mysqli_real_escape_string($db, $_POST["confmail"]): "";

            if($newEmail === $confEmail){
                $sql3 = "UPDATE `cs312groupk`.`users` SET `email` = '$confEmail' WHERE `id` = '$id'";
                $result3 = $db->query($sql3);
                if($result3){
                    echo "Email changed successfully";
                }else{
                    echo "Change failed";
                }
            }else{
                echo "Emails don't match, please try again";
            }
        }

        elseif(isset($_POST['editInstitution'])){
            $newInstitution = isset($_POST['newInstitution'])? mysqli_real_escape_string($db, $_POST['newInstitution']): "";
            $confInstitution = isset($_POST['confInstitution'])? mysqli_real_escape_string($db, $_POST['confInstitution']): "";

            if($newInstitution === $confInstitution){
                $sql4 = "UPDATE `cs312groupk`.`users` SET `institute` = '$confInstitution' WHERE `id` = '$id'";
                $result4 = $db->query($sql4);
                if($result4){
                    echo "Institution changed successfully";
                }else{
                    echo "Change failed";
                }
            }else{
                echo "Institutions don't match, please try again";
            }
        }
    ?>
    </div>
</div>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
