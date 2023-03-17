<?php
if(!isset($_SESSION)){
  session_start();
}

if(!isset($_SESSION['Access'])){
  header("Location: login.php");
}


include_once("connections/connection.php");
$con = connection();


if (isset($_POST['submit'])){


$sql = "SELECT * FROM cb_form ORDER BY cb_number";
$cbform = $con->query($sql) or die(con->connect_error);
$row = $cbform->fetch_assoc();

?>


<div class="table-responsive">
     
        <table class="table custom-table">
          <thead>
            <tr>
            <th scope="col">Date Insured</th>
              <th scope="col">CB Number</th>
              <th scope="col">Account Number</th>
              <th scope="col">Member Name </th>
          
         
            </tr>
          </thead>
          <tbody>
            <?php  do{?>
            <tr scope="row"> 
              <td><?php echo$row['date_insured']?></td>
              <td><?php echo$row['cb_number']?></td>
              <td><?php echo$row['account_number']?></td>
              <td><?php echo$row['full_name']?></td>
                
            
               
            
            </tr>

            <?php }while($row = $cbform->fetch_assoc())?> 


<?php

header('Content-Type: application/xls');
header('Content-Disposition:attachment;filename=cbform.xls');


}
?>