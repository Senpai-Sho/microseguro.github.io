<?php
if(!isset($_SESSION)){
  session_start();
}

if(!isset($_SESSION['Access'])){

  header("Location: login.php");
}

include_once("connections/connection.php");
$con = connection();

$sql = "SELECT * FROM insurance_product ORDER BY product_id";
$insuranceproducts = $con->query($sql) or die(con->connect_error);
$row = $insuranceproducts->fetch_assoc();

?>




<!doctype html>
<html lang="en">
  <head>
    <!--for icon -->
 
<meta name="viewport" content="width=device-width, initial-scale=1"> <!-- EDIT -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


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

  
  </head>

  <head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title> MICRO SEGURO MANAGEMENT </title>

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
  <link rel="stylesheet" type="text/css" href="printaccount.css" media="print">

</head>

<?php // ------------------------------- ?>

<head>
<style>
button{

  border:none;
  background-color:white;
}

.export{
  background-color: #38444d;
}

.print{
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
  <li><a href="insuranceaccount.php"><i class="fa fa-caret-square-o-left" style="font-size:24px;color:green"></a></i></li>
  <li style="float:right"><a><button onclick="window.print()" class="print" id="print-btn"> <i class="fa fa-print" style="font-size:23px;color:green"></i><b> PRINT </b></button></li></a>
  
  
  <form action="exportinsuranceproducts.php" method="POST">
  <li style="float:right"><a><button onclick="checkexport()" type="submit" class="export" name="submit"><i class="fa fa-file-excel-o" style="font-size:23px;color:green"></i><b> EXPORT </b></button></li></a>
</form>


</ul>


<BR>
    
    <div class="container">
    
    <table class="table custom-table">

<thead>
   
   <tr>


<th><h4>KPS-SEED MICROFINANCE INC.</H5>
<H3>MICRO SEGURO INSURANCE PRODUCTS </H3></th>

</tr>
          </thead>
        

</table>


      <?php if($_SESSION['Access'] == "MS Master" || $_SESSION['Access'] == "Developer"){?>
      <td><a href="addinsuranceproduct.php"><i class="fa fa-file-text-o" style="font-size:30px;color:green"></i></a>  &nbsp;  &nbsp;</td>
      <?php } ?>   
   
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
      
              <?php if($_SESSION['Access'] == "MS Master" || $_SESSION['Access'] == "Developer"){?>
                <td><a href="updateinsuranceproduct.php?ProductID=<?php echo $row['product_id'];?>"><i class="fa fa-toggle-up" style="font-size:25px;color:green"></i></a></td>
                <?php } ?>
      
                <?php if($_SESSION['Access'] == "MS Master"|| $_SESSION['Access'] == "Developer"){?>
                  <form action="deleteinsuranceproduct.php" method="post">
                <td><button onclick="checker()" type="submit" id="submit-btn" name="delete"><i class="fa fa-trash"  style="font-size:25px;color:red"></i></button>
                <td><input type="hidden" name="ProductID" value = "<?php echo $row['product_id'];?>"> 
                </form>
                <?php }?>
         
            
            </tr>

            <?php }while($row = $insuranceproducts->fetch_assoc())?> 
          </tbody>
        </table>
      </div>


    </div>

  </div>
    
    

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script>

    function checkexport(){

      var result=confirm('DO YOU WANT TO EXPORT THIS PRODUCTS?');

      if(result == false){

        event.preventDefault();
      }
    }



    function checker(){

      var result = confirm('ARE YOU SURE YOU WANT TO DELETE THIS PRODUCT ?');

      if(result == false){

        event.preventDefault();
      }
    }


    </script>

    


  </body>
</html>