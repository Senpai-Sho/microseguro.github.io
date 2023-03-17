<?php



include_once("connections/connection.php");
$con = connection();


if(isset($_POST['delete'])){

    $userid = $_POST['userid'];

    $sql ="DELETE FROM system_user WHERE id = '$userid'";
    $con->query($sql) or die ($con->error);

    echo header("location: usercode.php?UserAccess=".$_SESSION['Access']); 
}