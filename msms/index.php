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

  <li style="float:right"><a onclick="logout()" href="logout.php"><?php echo"Log Out ".$_SESSION['Access'],' '?><i class="fa fa-sign-out" style="font-size:28px;color:gray"></i></a></li>
</ul>






<!-- Features Section -->



<table>

 <td> <h1><b>Micro Seguro Management System</b></h1>
 <p>KPS-SEED MICROFINANCE INC.</p></td>
</table>



<br>
<br>
<br>
<br>

<table>
    <td><a href ="memberindex.php"><i class="fa fa-address-card-o" style="font-size:85px;color:green"></i></a>
      <p>Member
        <br>Information
      </p> </td>

    
   <td> <a href ="accounts.php"> <i class="fa fa-building-o" style="font-size:85px;color:green"></i></i></a>
      <p>Accounts</p></td>
   

    <td><a href ="report.php"><i class="fa fa-address-book-o" style="font-size:85px;color:green"></i></a>
      <p>Report</p></td>
 
 
   <td> <a href ="system.php"><i class="fa fa-laptop" style="font-size:85px;color:green"></i></a>
      <p>System</p></td>
   
    
</table>



<script>
  function logout(){

    var result = confirm('ARE YOU SURE YOU WANT TO LOG OUT ? ');

    if(result == false ){
      event.preventDefault();

    }
  }

  

</script>

</body>
</html>
