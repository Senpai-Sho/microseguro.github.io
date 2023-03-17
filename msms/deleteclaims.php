<?php


include_once("connections/connection.php");
$con = connection();




if(isset($_POST['delete'])){

   
    $formcode = $_POST['CODE'];

        $sql = "SELECT * FROM claims_file WHERE form_code = '$formcode'";
        $claimsfile = $con->query($sql) or die ($con->connect_error);
        $row1 = $claimsfile->fetch_assoc();

$account_number = $row1['account_number'];


    $sql = "DELETE FROM claims_file WHERE form_code = '$formcode'";
    $con->query($sql) or die ($con->error);

    $sql2 = "DELETE FROM formnumber_data WHERE form_code = '$formcode'";
    $con->query($sql2) or die ($con->error);

 
 
   
    
  
}
?>

<script>   history.back(); </script>