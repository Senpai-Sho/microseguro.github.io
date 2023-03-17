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
$insurance = $_POST['insurance'];

?>
<table>
<td>From: <?php echo $from_date;?></td>
<td>To: <?php echo $to_date; ?> </td>
<td>Product: <?php echo $insurance; ?></td>
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
          

          $query = "SELECT * FROM member_info WHERE date_insured BETWEEN '$from_date' AND '$to_date' AND product_type = '$insurance' ";
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
    </tr>


<?php



    }
}
header('Content-Type: application/xls');
header('Content-Disposition:attachment;filename=MICRO SIGURO INSURANCE PRODUCT REPORT.xls');


}
?>