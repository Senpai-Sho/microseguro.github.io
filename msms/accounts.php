<?php 

if(!isset($_SESSION)){

    session_start();

}
if(!isset($_SESSION['Access'])){
  header("Location: login.php");
}


include_once("connections/connection.php");
$con= connection();


?>

<!DOCTYPE html>
<html>
<head>
    <!--for icon -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



<title>MICRO SEGURO MANAGEMENT</title>




<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
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




body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif}
body {font-size: 16px;}
img {margin-bottom: -8px;}
.mySlides {display: none;}

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {

  text-align: center;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>

<ul>
<li><a href="index.php"><i class="fa fa-caret-square-o-left" style="font-size:24px;color:green"></a></i></li>
 
</ul>






<!-- Features Section -->



<table>
  <td><h1><b>Micro Seguro Management System</b></h1>
  <p>KPS-SEED MICROFINANCE INC.</p></td>
</table>
<br>
<br>
<br>
<br>
  
<table>
    <td><a href ="insuranceaccount.php"><i class="fa fa-folder-open" style="font-size:85px;color:green"></i></a>
      <p>Insurance Accounts</p></td>

   
    <td><a href ="kpsproducts.php"><i class="fa fa-folder-open" style="font-size:85px;color:green"></i></a>
      <p>KPS-Products</p></td>

  
    
    <td><a href ="forms.php"><i class="fa fa-folder-open" style="font-size:85px;color:green"></i></a>
    <p>Forms</p></td>
  

    
    <td><a href ="branchaccount.php"><i class="fa fa-folder-open" style="font-size:85px;color:green"></i></a>
    <p>Branch Account</p></td>

    



  


</body>
</html>
