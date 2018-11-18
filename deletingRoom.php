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

$chosenRoom = $_POST["confirm"];

if($chosenRoom != "no")
{
    // Issue the query
    $sql = "SELECT * FROM `rooms` WHERE id = '$chosenRoom'";
}

// Disconnect
$conn->close();

header("Location: https://devweb2018.cis.strath.ac.uk/~gxb16190/groupk/index.php");
exit();
?>