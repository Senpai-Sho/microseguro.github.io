<?php 
if(!isset($_SESSION)){
session_start();
}


include_once("connections/connection.php");
$con = connection();

$branches = $_GET["BRANCH"];



$sql = "SELECT * FROM  member_info WHERE branch_name = '$branches'";
$memberinfo = $con->query($sql) or die ($con->connect_error);
$row1 = $memberinfo ->fetch_assoc();


$sql = "SELECT * FROM kps_branches ORDER BY branch_account";
$kpsbranches = $con->query($sql) or die ($con->connect_error);
$row = $kpsbranches->fetch_assoc();

?>

<!doctype html>
<html lang="en">
  <head>
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

    <title>KPS SEED MICROFINANCE INC.</title>
  </head>

  <head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Micro Siguro Management</title>
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

<li><a href="home.php"><i class='fas fa-caret-square-left' style='font-size:24px;color:green'></i></a></li>
<?php do{?>

<li><a href="branchname2022.php?BRANCH=<?php echo$row['branch_name'];?>"><?php echo $row['branch_name']?></a></li>

 
<?php } while ($row = $kpsbranches->fetch_assoc())?>

 



</ul>

<div style="margin-left:25%;padding:1px 16px;height:1000px;">

<form action="" method="GET">

<input type="date" name="from_date" class="form-control">
<input type="date" name="to_date" class="form-control">




<button type="submit" class="btn btn-primary">BUTTON</button>

<h1><br><?php echo $row1['branch_name']?> Branch Information 2022</h1>

<form action="" method="GET">
<div class="content">
    
    <div class="container">
      <div class="table-responsive">

        <table class="table custom-table">
          <thead>
   
            <tr>
              
              <th scope="col">Full Name</th>
              <th scope="col">Branch</th>
              <th scope="col">Date Insured</th>
            
            </tr>
          </thead>
          <tbody>

      <tr scope="row"> 

      <?php if(isset($_GET['from_date']) && isset($_GET['to_date'])){

$from_date = $_GET['from_date'];
$to_date = $_GET['to_date'];

$query = "SELECT * FROM member_info WHERE date_insured BETWEEN '$from_date' AND '$to_date' AND branch_name = '$branches' ";
$query_run = mysqli_query($con, $query);

if(mysqli_num_rows($query_run) > 0 ){

    foreach($query_run as $row){
        ?>
        <tr>
         <td><?= $row['full_name'];?></td>
         <td><?= $row['branch_name'];?></td>
         <td><?= $row['date_insured'];?></td>
    </tr>
    <?php

    }

}
else
 {
    echo"Not Found";
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
<table>
  


</body>
</html>



