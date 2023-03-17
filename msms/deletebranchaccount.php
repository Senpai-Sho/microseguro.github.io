<?php 




include_once("connections/connection.php");
$con = connection();


if(isset($_POST['delete'])){

    $branchaccount = $_POST['branchID'];

    $sql ="DELETE FROM kps_branches WHERE branch_account = '$branchaccount'";
    $con->query($sql) or die ($con->error);

    echo header("location:branchaccount.php");
}