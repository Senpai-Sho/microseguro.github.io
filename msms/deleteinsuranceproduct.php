<?php 




include_once("connections/connection.php");
$con = connection();


if(isset($_POST['delete'])){

    $productaccount = $_POST['ProductID'];

    $sql ="DELETE FROM insurance_product WHERE product_id = '$productaccount'";
    $con->query($sql) or die ($con->error);

    echo header("location:insuranceproducts.php");
}