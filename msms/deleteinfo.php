<?php 





include_once("connections/connection.php");
$con = connection(); 

if(isset($_POST['delete'])){

    $accountnumber = $_POST['AccountNumber'];

    $sql = "SELECT * FROM  claims_file WHERE account_number = '$accountnumber'";
    $cblic = $con->query($sql) or die ($con->connect_error);
    $row1 = $cblic ->fetch_assoc();
    
    $total = $cblic->num_rows;
    
    if($total>0){?>
     
        <script>
        
        alert("YOU CAN NO LONGER DELETE THIS FORM");
                history.back();
        </script>
        

        <?php 
   

   }
    else{

    $sql2 = "DELETE FROM member_info WHERE account_number = '$accountnumber'";
    $con->query($sql2) or die ($con->error);

    $sql3 = "DELETE FROM cb_kalinga  WHERE account_number = '$accountnumber'";
    $con->query($sql3) or die ($con->error);

    $sql4 = "DELETE FROM cgl_data WHERE account_number = '$accountnumber'";
    $con->query($sql4) or die ($con->error);
    
    $sql5 = "DELETE FROM dchs_data WHERE account_number = '$accountnumber'";
    $con->query($sql5) or die ($con->error);
    

    $sql6 = "DELETE FROM cb_form WHERE account_number = '$accountnumber'";
    $con->query($sql6) or die ($con->error);

  
}   
?>  <script>   history.back(); </script>

<?php
}
?>

