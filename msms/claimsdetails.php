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



$sql = "SELECT * FROM  claims_file WHERE account_number = '$accountnumber'";
$cblic = $con->query($sql) or die ($con->connect_error);
$row1 = $cblic ->fetch_assoc();

$total = $cblic->num_rows;

if($total>0){

}else{
    
    echo header("Location: noclaimsfound.php?AccountNumber=".$accountnumber);
}



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
<link rel="stylesheet" type="text/css" href="printclaimsdata.css" media="print">


<title> MICRO SEGURO MANAGEMENT</title>

<style>





  .print{

    background-color: #38444d;
    cursor:pointer;
  }

  .border1{
    border:none;
    background-color: white;

  }
  button{
border:none;
background-color:white;
cursor:pointer;

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
 /* padding: 8px;*/
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
  <li><a href="claimsinfo.php"><i class="fa fa-caret-square-o-left" style="font-size:24px;color:green"></a></i></li>

  <form action="claimspreview.php" method="POST">
  <li style="float:right"><a><button type="submit" class="print" id="print-btn"> <i class="fa fa-print" style="font-size:23px;color:green"></i><b> PRINT PREVIEW </b></button></li></a>
  <input type="hidden" name="AccountNumber" value = "<?php echo $row['account_number'];?>"> 

</form>

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


<?php do{?>
<tr>
    <td><?php echo $row1['approval_date']?></td>
    <td><?php echo $row1['form_number']?></td>
    <td><?php echo $row1['patient_name']?></td>
    <td><?php echo $row1['membership_type']?></td>
    <td><?php echo $row1['claims_type']?></td>
    <td><?php echo $row1['days_number']?></td>

    <td><?php if($row1['kps_share'] ==""){
         echo "";
         }else { echo number_format($row1['kps_share']);}?></td>
            
    <td><?php if($row1['cblic_share'] ==""){
         echo "";
         }else { echo number_format($row1['cblic_share']);}?></td>
                    
  
    <td><?php echo $row1['from_confinement']?><br><?php echo $row1['to_confinement']?></td>
    <td><?php echo $row1['member_diagnos']?></td>
    <td><?php echo $row1['death_date']?></td>
    <td><?php echo $row1['member_explanation']?></td>

    
    <?php
          if($row['Status']== "Active"){?>
            <?php if($_SESSION['Access'] == "MS Supervisor"||$_SESSION['Access'] == "Developer"){?>
              <td class="border1"><a href="updateclaims.php?CODE=<?php echo $row1['form_code'];?>"><i class="fa fa-toggle-up" style="font-size:25px;color:green"></i></a>
              <?php }?>


          
              <?php if($_SESSION['Access'] == "MS Supervisor"|| $_SESSION['Access'] == "Developer"){?>
                <form action="deleteclaims.php" method="post">
              <td class="border1"><button onclick="checker()"  type="submit"  name="delete"><i class="fa fa-trash" style="font-size:25px;color:red"></i></button>
              <td class="border1"><input type="hidden" name="CODE" value = "<?php echo $row1['form_code'];?>"> 
              </form>
         <?php }else{
                  echo "";
    ?>

   
                <?php }}?>
         


</tr>

<?php }while($row1 = $cblic->fetch_assoc())?>

<tr>


<?php if($row == ""){
      echo ""; 

   }
      else{ ?>
  
  
        <td class="border1"></td>
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

<script>

function checker(){

  var result = confirm('ARE YOU SURE YOU WANT TO DELETE THIS CLAIMS ?');

  if(result == false){

    event.preventDefault();
  }
}

  </script>


</body>
</html>




