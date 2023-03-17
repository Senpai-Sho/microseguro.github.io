<?php 



include_once("connections/connection.php");
$con = connection();


if(isset($_POST['delete'])){

    $accountnumber = $_POST['AccountNumber'];

    $sql ="DELETE FROM member_account WHERE account_number = '$accountnumber'";
    $con->query($sql) or die ($con->error);

    echo header("location:memberaccount.php");
}