
<?php 

if(!isset($_SESSION)){

    session_start();

}

if(!isset($_SESSION['Access'])){

    header("Location: login.php");
}


include_once("connections/connection.php");
$con = connection();




$from_date = $_POST['from'];
$to_date = $_POST['to'];
$branchname = $_POST['branch'];


if(isset($_POST['close'])){

    $accountnumber = $_POST['AccountNumber'];
    $updatestatus = "Closed";
   echo  $accountnumber;

   $sql ="SELECT * FROM member_info WHERE account_number = '$accountnumber'";
   $memberproduct = $con->query($sql) or die ($con->connect_error);
   $row = $memberproduct->fetch_assoc();

   
   if ($row['product_type'] == "CGL-Loan Insurance"){

    $sql8 ="UPDATE member_info SET Status = '$updatestatus' WHERE account_number = '$accountnumber' ";
    $con->query($sql8) or die ($con->error);

    $sql7 ="UPDATE cgl_data SET Status = '$updatestatus' WHERE account_number = '$accountnumber' ";
    $con->query($sql7) or die ($con->error);

   }else{

   $sql5 ="UPDATE member_info SET Status = '$updatestatus' WHERE account_number = '$accountnumber' ";
   $con->query($sql5) or die ($con->error);

   $sql6 ="UPDATE cb_kalinga SET Status = '$updatestatus' WHERE account_number = '$accountnumber' ";
   $con->query($sql6) or die ($con->error);

    }

   
    echo header("location: renewal.php"."?from_date=".$from_date."&to_date=".$to_date."&branchname=".$branchname); 
   

}