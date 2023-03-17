<?php 

if(!isset($_SESSION)){

    session_start();

}


if(!isset($_SESSION['Access'])){

  header("Location: login.php");
}


include_once("connections/connection.php");
$con= connection();

$sql = "SELECT * FROM product_info ORDER BY product_id ";
$productinfo = $con->query($sql) or die ($con->connect_error);
$row = $productinfo->fetch_assoc();

$sql1 = "SELECT * FROM kps_branches ORDER BY branch_account";
$kpsbranches = $con->query($sql1) or die ($con->connect_error);
$row1 = $kpsbranches->fetch_assoc();






?>

<!doctype html>
<html lang="en">
  <head>
    <!--for icon -->

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--for icon -->



    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">

   
   <title> MICRO SEGURO MANAGEMENT </title>

    
  </head>

  <head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="printreports.css" media="print">

</head>

<?php // ------------------------------- ?>

<head>
<style>
  button{
border:none;
background-color: #38444d;

  }


body {
  background-color:white;
}
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #38444d;
}

li {
  float: left;
}

li a, .dropbtn {
  display: inline-block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover, .dropdown:hover .dropbtn {
  background-color: green;
}

li.dropdown {
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {background-color: #f1f1f1;}

.dropdown:hover .dropdown-content {
  display: block;
}

h3,h1 ,h4{
  text-align: center;

}

</style>
</head>  


  <body>

  <ul>
  <li><a href="report.php"><i class="fa fa-caret-square-o-left" style="font-size:24px;color:green"></a></i></li>
  <li style="float:right"><a><button onclick="window.print()" class="print" id="print-btn"> <i class="fa fa-print" style="font-size:23px;color:green"></i><b> PRINT </b></button></li></a>

  <form action="exportproducttobranch.php" method="POST">

<td><input  type="hidden" name="from"  value="<?php if(isset($_GET['from_date'])) { echo $_GET['from_date'];}?>" class="form-control"></td>
<td><input   type="hidden" name="to" value = "<?php if(isset($_GET['to_date'])) { echo $_GET['to_date'];}?>" class="form-control"></td>
<td><input   type="hidden" name="branch" value = "<?php if(isset($_GET['branchname'])) { echo $_GET['branchname'];}?>" class="form-control"></td>
<td><input   type="hidden" name="product" value = "<?php if(isset($_GET['productinfo'])) { echo $_GET['productinfo'];}?>" class="form-control"></td>


<li style="float:right"><a><button onclick="checker()" type="submit" name="submit"><i class="fa fa-file-excel-o" style="font-size:23px;color:green"></i><b> EXPORT </b> </button></li></a>

</form>



</ul>


<br>


<table class="table custom-table">

<thead>
   
   <tr>


<th><h4>KPS-SEED MICROFINANCE INC.</H5>
<H3>MICRO SEGURO KPS-PRODUCT PER BRANCH REPORT </H3></th>

</tr>
          </thead>
        

</table>
<br>

<form action="" method="GET">
<table>
<td><input  style="width:150px;" type="date" name="from_date"  value="<?php if(isset($_GET['from_date'])) { echo $_GET['from_date'];}?>" class="form-control"></td>
<td><input  style="width:150px;"  type="date" name="to_date" value = "<?php if(isset($_GET['to_date'])) { echo $_GET['to_date'];}?>" class="form-control"></td>

<td><select id= "id" name="productinfo" class="form-control">
<?php if ($_GET['productinfo'] == ""){
echo "";
}else{?>
<option value = "<?php if(isset($_GET['productinfo'])){ echo $_GET['productinfo'];}?>"><?php  echo $_GET['productinfo'];}?>

	<?php do {?>

	<option value="<?php echo $row['product_name']?>"><?php echo $row['product_name']?></option>
	<?php } while ($row = $productinfo->fetch_assoc())?>
   
    </td>
      </select>

      <td><select id= "id" name="branchname" class="form-control">
        <?php if($_GET['branchname'] == ""){
            echo "";
        }else{?>
    <option value = "<?php if(isset($_GET['branchname'])){ echo $_GET['branchname'];}?>"><?php  echo $_GET['branchname'];}?>
	<?php do {?>

	<option value="<?php echo $row1['branch_name']?>"><?php echo $row1['branch_name']?></option>
	<?php } while ($row1 = $kpsbranches->fetch_assoc())?>
    </td>
      </select>



<td>&nbsp <button type="submit" id="submit-btn"  class="btn btn-primary">Generate</button></td>
</table>

<br>

<form action="" method="GET">


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

      <tr scope="row"> 

      <?php if(isset($_GET['from_date']) && isset($_GET['to_date']) && isset($_GET['productinfo']) && isset($_GET['branchname']) ){

$from_date = $_GET['from_date'];
$to_date = $_GET['to_date'];
$productinfo = $_GET['productinfo'];
$branchname = $_GET['branchname'];


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
}
?>
</tbody>
        </table>

   
    </tr>
    
</table>
</div>
<script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>

<script>

function checker(){

  var result = confirm('DO YOU WANT TO EXPORT THIS REPORT ?');

  if(result == false){

    event.preventDefault();
  }
}

  </script>
  


</body>
</html>



