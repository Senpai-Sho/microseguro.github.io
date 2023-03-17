<?php
if(!isset($_SESSION)){
  session_start();
}

if(!isset($_SESSION['Access'])){
  header ("Location: login.php");
}


include_once("connections/connection.php");
$con = connection();


if (isset($_POST['submit'])){

$sql = "SELECT * FROM claims_data ORDER BY claims_id";
$claimsaccount = $con->query($sql) or die(con->connect_error);
$row = $claimsaccount->fetch_assoc();

?>

<div class="table-responsive">
     <BR>
        <table class="table custom-table">
          <thead>
            <tr>
              
              <th scope="col">Claims ID</th>
              <th scope="col">Claims Name</th>
              <th scope="col">Classification</th>
          
         
            </tr>
          </thead>
          <tbody>
            <?php  do{?>
            <tr scope="row"> 

              <td><?php echo$row['claims_id']?></td>
              <td><?php echo$row['claims_name']?></td>
              <td><?php echo$row['claims_classifaction']?></td>
      

              <?php }while($row = $claimsaccount->fetch_assoc())?> 
          </tbody>
        </table>
      </div>

      <?php 

header('Content-Type: application/xls');
header('Content-Disposition:attachment;filename=claimsaccount.xls');


            }
?>