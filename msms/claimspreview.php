<?php 
if (!isset($_SESSION)){

    session_start();
}

if(!isset($_SESSION['Access'])){

  header("Location: login.php");
}

include_once("connections/connection.php");
$con = connection();


$accountnumber = $_POST['AccountNumber'];




$sql = "SELECT * FROM  member_info WHERE account_number = '$accountnumber'";
$memberinfo = $con->query($sql) or die ($con->connect_error);
$row = $memberinfo ->fetch_assoc();


$sql = "SELECT * FROM  cb_kalinga WHERE account_number = '$accountnumber' ";
$cblic = $con->query($sql) or die ($con->connect_error);
$row3 = $cblic ->fetch_assoc();


$sql = "SELECT * FROM  cgl_data WHERE account_number = '$accountnumber' ";
$cblic = $con->query($sql) or die ($con->connect_error);
$row4 = $cblic ->fetch_assoc();




$sql = "SELECT * FROM  claims_file WHERE account_number = '$accountnumber'";
$cblic = $con->query($sql) or die ($con->connect_error);
$row5 = $cblic ->fetch_assoc();



$querytotal = "SELECT SUM(kps_share) AS sum FROM `claims_file` WHERE account_number =  '$accountnumber' ";
$query_result = mysqli_query($con, $querytotal);

while($row1= mysqli_fetch_assoc($query_result)){

  $kpsshare = $row1['sum'];
}

$querycblic = "SELECT SUM(cblic_share) AS sum FROM `claims_file` WHERE account_number = '$accountnumber' " ;
$query_resultcblic = mysqli_query($con, $querycblic);

while($row2= mysqli_fetch_assoc($query_resultcblic)){

  $cblicshare = $row2['sum'];
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<title> MICRO SEGURO MANAGEMENT </title>

<link rel="stylesheet" type="text/css" href="printclaimspreview.css" media="print">

</head>
<style>

  .print{

    background-color: #38444d;
    cursor:pointer;
  }

  .border1{
    border:none;

  }
  button{
border:none;
background-color: #dddddd;

  }



h1 {text-align: center;}


h3,h5{
  text-align: center;
}




table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}


td, th {
  border: 1px solid #dddddd;
  text-align: left;
 /* padding: 8px;*/
}

tr:nth-child(even) {
 
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


<body>
    
<ul>
  <li><a href="claimsdetails.php?AccountNumber=<?php echo $accountnumber?>"><i class="fa fa-caret-square-o-left" style="font-size:24px;color:green"></a></i></li>
  <li style="float:right"><a><button onclick="window.print()" class="print" id="print-btn"> <i class="fa fa-print" style="font-size:23px;color:green"></i><b> PRINT </b></button></li></a>

</ul>

<table>

<tr>
<thead class="report-header"> <h5>KPS-SEED MICROFINANCE INC.</H5>
    <H3>MICRO SEGURO CLIENT CLAIMS DISBURSEMENT </H3> </th>
</tr>

<tr>
   <td>Account Number<br> <b><?php echo $row['account_number']?></b></td>
   <td>Member Name<br> <b><?php echo $row['full_name']?></b></td>
   <td>Civil Status<br> <b><?php echo $row['civil_status']?></b></td>
   <td>Gender<br> <b><?php echo $row['gender']?></b></td>
</tr>

<tr>
<td>Address<br> <b><?php echo $row['address']?></b></td>
<td>Product Type <br> <b><?php echo $row['product_type']?></b></td>
<td>Loan Product<br> <b><?php echo $row['loan_product']?></b></td>
<td>Branch<br> <b><?php echo $row['branch_name']?></b></td>
</tr>

<tr>
<td>Date of Birth<br> <b><?php echo $row['birth_date']?></b></td>
<td>Date of Membership<br> <b><?php echo $row['date_member']?></b></td>
<td>Date Insured<br> <b><?php echo $row['date_insured']?></b></td>
<td>Renewal Date<br> <b><?php echo $row['renewal']?></b></td>

</tr>

<tr>
<td>Confirmation of Coverage<br> <b><?php echo $row['coc']?></b></td>
<td>Length of Membership <br> <b><?php echo $row['length']?></b></td>
<td>Unit<br> <b><?php echo $row['unit']?></b></td>
<td>Loan Status<br> <b><?php echo $row['loan_status']?></b></td>
</tr>
</table>

<table class="report-container">
    
<tr>


<p> BENEFICIARY: &nbsp <b> 
<?php if($row['product_type'] == "CGL-Loan Insurance" ){

echo $row4['b_lastname'].', '.$row4['b_firstname'].' '.$row4['b_middleinitial'];

}else{

  echo $row3['b_lastname'].', '.$row3['b_firstname'].' '.$row3['b_middleinitial'];
}

?>    
</p> 


</tr>


<tr>
<th>Approval Date</th>
<th>Form Number</th>
<th>Patient Name</th>
<th>Type of Membership</th>
<th>Number of Days</th>
<th>KPS-Share</th>
<th>CBLIC-Share</th>
<th>Date Confinement</th>
<th>Diagnos</th>
<th>Date of Death</th>
<th>Explanation</th>
</tr>

 <?php do{?>



   




<tr>
<td class="border2"><?php echo $row5['approval_date']?>
<td class="border2"><?php echo $row5['form_number']?>
<td class="border2"><?php echo $row5['patient_name']?>
<td class="border2"><?php echo $row5['membership_type']?>
<td class="border2"><?php echo $row5['claims_type']?>
<td class="border2"><?php if($row5['kps_share'] ==""){
         echo "";
         }else { echo number_format($row5['kps_share']);}?></td>
            
            <td class="border2"><?php if($row5['cblic_share'] ==""){
         echo "";
         }else { echo number_format($row5['cblic_share']);}?></td>
                    
                    <td class="border2"><?php echo $row5['to_confinement']?>
                    <td class="border2"><?php echo $row5['member_diagnos']?>
                    <td class="border2"><?php echo $row5['death_date']?>
                    <td class="border2"><?php echo $row5['member_explanation']?>
</tr>





<?php }while($row5 = $cblic->fetch_assoc())?>

<tr>


<?php if($row == ""){
      echo ""; 

   }
      else{ ?>
  
  
    
        <td class="border1"></td>
        <td class="border1"></td>
        <td class="border1"></td>
        <td class="border1"></td>
        <td class="border1"><b><br><br>TOTAL</td>
        <td class="border1"><b><br><br><?php echo number_format($kpsshare)?></td>
        <td class="border1"><b><br><br><?php echo number_format($cblicshare)?></td>
      </tr>
     <?php }
?>    


</table>

</body>
</html>