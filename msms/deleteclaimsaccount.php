<?php 



include_once("connections/connection.php");
$con = connection();


if(isset($_POST['delete'])){

    $productaccount = $_POST['ClaimsID'];

    $sql ="DELETE FROM claims_data WHERE claims_id = '$productaccount'";
    $con->query($sql) or die ($con->error);

    echo header("location:claimsaccount.php");
}