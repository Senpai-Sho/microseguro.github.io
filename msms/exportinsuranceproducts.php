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

$sql = "SELECT * FROM insurance_product ORDER BY product_id";
$insuranceproducts = $con->query($sql) or die(con->connect_error);
$row = $insuranceproducts->fetch_assoc();

?>

<table class="table custom-table">
<thead>
  <tr>
    
    <th scope="col">Product ID</th>
    <th scope="col">Product Name</th>
    <th scope="col">Classification</th>


  </tr>
</thead>
<tbody>
  <?php  do{?>
  <tr scope="row"> 

    <td><?php echo$row['product_id']?></td>
    <td><?php echo$row['product_name']?></td>
    <td><?php echo$row['classification']?></td>


    <?php }while($row = $insuranceproducts->fetch_assoc())?> 


  </tr>
<?php

header('Content-Type: application/xls');
header('Content-Disposition:attachment;filename=insuranceproducts.xls');

}
?>

