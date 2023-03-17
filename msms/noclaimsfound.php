<?php 
if (!isset($_SESSION)){

    session_start();
}


if(!isset($_SESSION['Access'])){
  header("Location: login.php");
}

include_once("connections/connection.php");
$con = connection();


$accountnumber = $_GET["AccountNumber"];


$sql = "SELECT * FROM  member_info WHERE account_number = '$accountnumber'";
$memberinfo = $con->query($sql) or die ($con->connect_error);
$row = $memberinfo ->fetch_assoc();

?>


<!DOCTYPE html>
<html>
<head>
 <!--for icon -->
 <meta name='viewport' content='width=device-width, initial-scale=1'>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--for icon -->
<link rel="stylesheet" type="text/css" href="printnoclaimsinfo.css" media="print">



<title> MICRO SEGURO MANAGEMENT </title>


<style>

input[type=submit] {
  background-color: #04AA6D;
  border: black;
  color: white;
  padding: 16px 32px;
  text-decoration: none;
  margin: 4px 2px;
  cursor: pointer;
}


h1 {text-align: center;}

h3,h5 {
  text-align: center;
}

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}


td, th {
  border: 3px solid #dddddd;
  text-align: left;
  padding: 3px;
}

tr:nth-child(even) {
  background-color: #dddddd;
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
  <li><a href="claimsinfo.php"><i class="fa fa-caret-square-o-left" style="font-size:24px;color:green"></a></i>
 
</ul>


<table class="report-container">

<tr>
<thead class="report-header">
  <th>
<h5>KPS-SEED MICROFINANCE INC.</H5>
<H3>MICRO SEGURO CLIENT CLAIMS DISBURSEMENT </H3>
</th>
</tr>
</table>


<table>

  <tr>
    <td>Account Number:</td>
    <td><b><?php echo $row['account_number'];?></b></td>
    <td>Member Name:</td>
   <td><b><?php echo$row['full_name']?></b></td>
   <td>Civil Status:</td>         
   <td><b><?php echo$row['civil_status']?></b></td>
   
  </tr>
  

  <tr>
    <td>Date of Membership:</td>
    <td><b><?php echo$row['date_member']?></b></td>
    <td>Date of Birth:</td>
    <td><b><?php echo$row['birth_date']?></b></td>
    <td>Gender:</td>
    <td><b><?php echo$row['gender']?></b></td>  
  </tr>

  <tr>
  <td>Address:</td>
    <td><b><?php echo$row['address']?></b></td>  
   <td>Product Type:</td>
   <td><b><?php echo $row['product_type']?></b></td>
   <td>Loan Product: </td>
   <td><b><?php echo $row['loan_product']?></b></td>

</tr>
<tr>
<td>Date Insured:</td>
<td><b><?php echo $row['date_insured']?></b></td>
<td>Renewal Date:</td>
<td><b><?php echo $row['renewal']?></b></td>
<td>Branch Name :</td>
<td><b><?php echo $row['branch_name']?></b></td>
</tr>

<tr>
<td>Confirmation of Coverage:</td>
<td><b><?php echo $row['coc']?></b></td>
<td>Length of Membership:</td>
<td><b><?php echo $row['length']?></b></td>
<td>Unit:</td>
<td><b><?php echo $row['unit']?></b></td>
</tr>

<tr>
<td>Loan Status:</td>
<td><b><?php echo $row['loan_status']?></b></td>
</tr>


</table>
<br>
<table>
<th>Approval Date </th>
<th>Form No.</th>
<th>Patient Name</th>
<th>Type of Membership</th>
<th>Type of Claims</th>
<th>Number of Days</th>
<th>KPS-Share</th>
<th>CBLIC-Share</th>
<th>Date Confinement</th>
<th>Diagnos</th>
<th>Date of Death</th>
<th>Explanation</th>
</table>



</body>
</html>

