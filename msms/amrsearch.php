<?php
if(!isset($_SESSION)){
  session_start();
}

if(!isset($_SESSION['Access'])){
  header("Location: login.php");

}



include_once("connections/connection.php");
$con = connection();

$search = $_GET['search'];

$sql = "SELECT * FROM member_info WHERE account_number LIKE '$search%' || full_name LIKE '%$search%' ORDER BY account_number DESC ";
$amr = $con->query($sql) or die ($con->connect_error);
$row = $amr->fetch_assoc();

$total = $amr->num_rows;
    
if($total>0){
}else{
    echo header("Location: amr.php");
}


?>




<!doctype html>
<html lang="en">
  <head>
    <!--for icon -->
  <meta name='viewport' content='width=device-width, initial-scale=1'>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

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

    <title>MICRO SEGURO MANAGEMENT</title>
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


</head>

<?php // ------------------------------- ?>

<head>
<style>
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
</style>
</head>  


  <body>

  <ul>
  <li><a href="claimsselect.php"><i class="fa fa-caret-square-o-left" style="font-size:24px;color:green"></a></i></li>


</ul>


  <div class="content">
    
    <div class="container">
      <br>
      <br>
      <h2 class="mb-5">Select Account</h2>

      <form action ="amrsearch.php" method="get">
        <table>
      
      <td><input type="text" name = "search"  id="search" autocomplete="off">  <button type="submit"><i class="fa fa-search"></i></button></td>

</table>
</form>
      
      <div class="table-responsive">
     
        <table class="table custom-table">
          <thead>
            <tr>
              
              <th scope="col">Account Number</th>
              <th scope="col">Confirmation of Coverage</th>
              <th scope="col">Name</th>
              <th scope="col">Unit</th>
              <th scope="col">Product Type</th>
              <th scope="col">Date of Membership</th>
              <th scope="col">Date Insured</th>
              <th scope="col">Renewal Date</th>
            </tr>
          </thead>
          <tbody>
            <?php  do{?>
            <tr scope="row"> 

            <?php if($row['Status'] == "Closed" || $row['Status'] == "Renewed"){

              echo " ";
            }else{?>
          
              <td><?php echo$row['account_number']?></td>
              <td><?php echo$row['coc']?></td>
              <td><?php echo$row['full_name']?></td>
              <td><?php echo$row['unit']?></td>
              <td><?php echo$row['product_type']?></td>
              <td><?php echo$row['date_member']?></td>
              <td><?php echo$row['date_insured']?></td>
              <td><?php echo$row['renewal']?></td>
              <td><a href="amrform.php?AccountNumber=<?php echo $row['account_number'];?>"><i class="fa fa-caret-square-o-right" style="font-size:24px;color:green"></i></td>
            
              <?php }?>
         
            
            </tr>

            <?php }while($row = $amr->fetch_assoc())?> 
          </tbody>
        </table>
      </div>


    </div>

  </div>
    
    

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>