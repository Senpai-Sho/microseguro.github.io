<?php 

if(!isset($_SESSION)){

    session_start();

}


if(!isset($_SESSION['Access'])){
  header("Location: login.php");
}


include_once("connections/connection.php");
$con= connection();

$from_date = $_POST['from'];
$to_date = $_POST['to'];
$perclaims = $_POST['cl'];
$branchname = $_POST['branch'];

?>
<table>
<td>From: <?php echo $from_date;?></td>
<td>To: <?php echo $to_date; ?> </td>
<td>Product: <?php echo $perclaims; ?></td>
<td>Branch: <?php echo $branchname; ?></td>
</table>
<?php


if (isset($_POST['submit'])){
?>

<table class="table custom-table">
          <thead>
   
            <tr>
              
              <th scope="col">Account Number</th>
              <th scope="col">Full Name</th>
              <th scope="col">Form No.</th>
              <th scope="col">Approval Date</th>
              <th scope="col">Type of Claims</th>
              <th scope="col">KPS-Share</th>
              <th scope="col">CBLIC-Share</th>
              <th scope="col">Branch</th>
             
           
            
            </tr>
          </thead>
          <tbody>
            <?php

          $querytotal = "SELECT SUM(kps_share) AS sum FROM `claims_file` WHERE approval_date BETWEEN '$from_date' AND '$to_date' AND claims_type = '$perclaims' ";
$query_result = mysqli_query($con, $querytotal);

while($row= mysqli_fetch_assoc($query_result)){

  $kpsshare = $row['sum'];
}

$querycblic = "SELECT SUM(cblic_share) AS sum FROM `claims_file` WHERE approval_date BETWEEN '$from_date' AND '$to_date' AND claims_type = '$perclaims' ";
$query_resultcblic = mysqli_query($con, $querycblic);

while($row= mysqli_fetch_assoc($query_resultcblic)){

  $cblicshare = $row['sum'];
}



$query = "SELECT * FROM claims_file WHERE approval_date BETWEEN '$from_date' AND '$to_date' AND claims_type = '$perclaims' AND branch_name = '$branchname'";
$query_run = mysqli_query($con, $query);



if(mysqli_num_rows($query_run) > 0 ){
  ?>
  <h5 style="color:green;"> <?php echo "<b> &nbsp TOTAL ACCOUNTS: ".mysqli_num_rows($query_run); ?></h5>  


  <?php
 
  
    foreach($query_run as $row){
        ?>
        <tr>
         <td><?= $row['account_number'];?></td>
         <td><?= $row['full_name'];?></td>
         <td><?= $row['form_number'];?></td>
         <td><?= $row['approval_date'];?></td>
         <td><?= $row['claims_type'];?></td>
         
         <td><?php if($row['kps_share'] ==""){
         echo "";
         }else { echo number_format($row['kps_share']);}?></td>

        <td><?php if($row['cblic_share'] ==""){
         echo "";
         }else { echo number_format($row['cblic_share']);}?></td>

      <td><?= $row['branch_name'];?></td>
       
         
        
         <td><br></td>
    </tr>

       

    <?php

    }

}
else
 {
    echo"";
}
}
?>
  <?php if($row == ""){
      echo ""; 

   }
      else{ ?>
  
  <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
     <td><b>TOTAL</td>
     <td><b><?php echo number_format($kpsshare)?></td>
     <td><b><?php echo number_format($cblicshare)?></td>
      </tr>
     <?php 
  
    }
    header('Content-Type: application/xls');
    header('Content-Disposition:attachment;filename=MICRO SIGURO CLAIMS DISBURSEMENT PER BRANCH REPORT.xls');
     
?>    

</tbody>

        </table>
