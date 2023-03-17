<?php 

if(!isset($_SESSION)){

    session_start();

}

if(!isset($_SESSION['Access'])){
  header("Location: login.php");
}



include_once("connections/connection.php");
$con= connection();

$branch = $_GET['BRANCH'];

$sql = "SELECT * FROM kps_branches ORDER BY branch_account";
$kpsbranch = $con->query($sql) or die ($con->connect_error);
$row = $kpsbranch->fetch_assoc();

$sql = "SELECT * FROM member_info WHERE branch_name = '$branch' ";
$memberbranch = $con->query($sql) or die ($con->connect_error);
$row1 = $memberbranch->fetch_assoc();


?>


<!doctype html>
<html lang="en">
  <head>

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


<style>
body {
  margin: 0;
}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  width: 25%;
  background-color: #f1f1f1;
  position: fixed;
  height: 100%;
  overflow: auto;
}

li a {
  display: block;
  color: #000;
  padding: 8px 16px;
  text-decoration: none;
}

li a.active {
  background-color: #04AA6D;
  color: white;
}

li a:hover:not(.active) {
  background-color: #90ee90;
  color: white;
}
</style>
</head>
<body>

<ul>

<li><a href="memberindex.php"><i class="fa fa-caret-square-o-left" style="font-size:24px;color:green"></a></i></li>
<?php do{?>
    <li><a href="memberbranch.php?BRANCH=<?php echo$row['branch_name'];?>"><?php echo $row['branch_name'];?></a></li>

<?php } while($row = $kpsbranch->fetch_assoc())?>
</ul>

<div style="margin-left:25%;padding:1px 16px;height:1000px;">



<h1><br><?php if(isset($_GET['BRANCH'])) { echo $_GET['BRANCH'];}?> Branch List</h1>




 <div class="content">
    
    <div class="container">
      <div class="table-responsive">

        <table class="table custom-table">
          <thead>
   
            <tr>
              
              <th scope="col">Account Number</th>
              <th scope="col">Full Name</th>
              <th scope="col">Product Type</th>
              <th scope="col">Loan Product</th>
              <th scope="col">Renewal Date</th>
            
            </tr>
          </thead>
          <tbody>
   
         <?php if($row1 == ""){

            echo " ";
         }else{


         


     do{?>
  <tr scope="row"> 

          <td><?php echo$row1['account_number']?></td>
          <td><?php echo$row1['full_name']?></td>
          <td><?php echo$row1['product_type']?></td>
          <td><?php echo$row1['loan_product']?></td>
          <td><?php echo$row1['renewal']?></td>


          <?php } while($row1 = $memberbranch->fetch_assoc()) ?>

        <?php } ?>
         
        
        
      
</body>
</html>



