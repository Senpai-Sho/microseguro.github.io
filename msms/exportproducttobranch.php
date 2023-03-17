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
$productinfo = $_POST['product'];
$branchname = $_POST['branch'];

?>
<table>
<td>From: <?php echo $from_date;?></td>
<td>To: <?php echo $to_date; ?> </td>
<td>Product: <?php echo $productinfo; ?></td>
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
        <th scope="col">Date Insured</th>
        <th scope="col">Renewal Date</th>
        <th scope="col">Loan Product</th>
        <th scope="col">Product</th>
        <th scope="col">Status</th>
        <th scope="col">Branch Name</th>
     
      
      </tr>
    </thead>
    <tbody>

    <?php
    $query = "SELECT * FROM member_info WHERE date_insured BETWEEN '$from_date' AND '$to_date' AND loan_product = '$productinfo' AND branch_name = '$branchname'";
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
         <td><?= $row['date_insured'];?></td>
         <td><?= $row['renewal'];?></td>
         <td><?= $row['loan_product'];?></td>
         <td><?= $row['product_type'];?></td>
         <td><?= $row['Status'];?></td>
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
header('Content-Type: application/xls');
header('Content-Disposition:attachment;filename=MICRO SIGURO KPS-PRODUCT PER BRANCH REPORT.xls');


}
?>
</tbody>
        </table>

