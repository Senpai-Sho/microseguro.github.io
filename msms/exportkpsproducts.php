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

$sql = "SELECT * FROM product_info ORDER BY product_id";
$kpsproducts = $con->query($sql) or die(con->connect_error);
$row = $kpsproducts->fetch_assoc();

?>
<div class="table-responsive">
     
          <BR>

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


              <?php }while($row = $kpsproducts->fetch_assoc())?> 

<?php

header('Content-Type: application/xls');
header('Content-Disposition:attachment;filename=kpsproducts.xls');


}
?>