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

if(isset($_POST['submit'])){

    $account = $_POST['accountnumber'];
    $fname = $_POST['fullname'];
    $approval = $_POST['approvaldate'];
    $patient = $_POST['patientname'];
    $membertype = $_POST['typeofmembership'];
    $claimtype = $_POST['typeofclaims'];
    $days = $_POST['numberofdays'];
    $from = $_POST['from'];
    $to  = $_POST['to'];
    $kps = $_POST['kpsshare'];
    $cblic = $_POST['cblicshare'];
    $diagnos = $_POST['diagnos'];
    $explain = $_POST['explanation'];
    $form = $_POST['formnumber'];
    $formcode = $_POST['code'];
    $branch = $_POST['branchname'];

  $errors = array();

  $formnum = "SELECT form_number FROM formnumber_data WHERE form_number = '$form' ";
  $formnumber = mysqli_query($con,$formnum); //duplicate

  if (empty($form)){
    $errors['forms'] = "Form Number Required";

  }
  if (empty($approval)){
    $errors['approval'] = "Approval Date Required";

  }

  if(empty($patient)){
    $errors['patient'] = "Patient Name Required";
  }

  if(empty($membertype)){
    $errors['membertype'] = "Type of Membership Required";
  }
  


  if(empty($from)){ 
    $errors['from'] = "From Date of Confinements Required";
  }

  if(empty($to)){
    $errors['to'] = "To Date of Confinements Required";
  }


  if (count($errors)==0){
  

$sql = "INSERT INTO `claims_file`(`account_number`,`full_name`,`approval_date`,`form_number`,`patient_name`,
`membership_type`,`claims_type`,`days_number`,`from_confinement`,`to_confinement`,`kps_share`,
`cblic_share`,`member_diagnos`,`member_explanation`,`form_code`,`branch_name`)
 VALUES('$account','$fname','$approval','$form','$patient','$membertype','$claimtype','$days',
 '$from','$to','$kps','$cblic','$diagnos','$explain','$formcode','$branch')";
$con->query($sql) or die ($con->error);

$sql = "INSERT INTO `formnumber_data`(`account_number`,`full_name`,`form_number`,`claims_type`,`approval_date`,`patient_name`,`form_code`,`branch_name`)
VALUES('$account','$fname','$form','$claimtype','$approval','$patient','$formcode','$branch')";
$con->query($sql) or die ($con->error);


  if ($con){
    echo "<script>alert('done')</script>";
  }else{ 
    echo "<script>alert('Failed')</script>";
  }

echo header ("location:claimsdetails.php?AccountNumber=".$accountnumber);


}
}

$sql ="SELECT * FROM member_info WHERE account_number = '$accountnumber'";
$memberproduct = $con->query($sql) or die ($con->connect_error);
$row = $memberproduct->fetch_assoc();

$sql1 = "SELECT * FROM claims_data WHERE claims_id = '002'";
$claimsdata = $con->query($sql1) or die ($con->connection_error);
$row1 = $claimsdata->fetch_assoc();

$sql2 = "SELECT * FROM claims_file ORDER BY id DESC";
$claimsfile = $con->query($sql2) or die ($con->connecion_error);
$row2 = $claimsfile->fetch_assoc();

$code =$row2['id'];
$codes = 1;



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

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}


td, th {
  border: 3px solid #dddddd;
  text-align: left;
  padding: 8px;
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
  <li><a href="claimsselect.php"><i class="fa fa-caret-square-o-left" style="font-size:24px;color:green"></a></i></li>


</ul>
<form action="" method="post">
<h2>ACCIDENTAL MEDICAL REIMBURSE</h2>

<input type="hidden" value="<?php echo $code+$codes;?>" id="code" name="code">
<input type="hidden" value="<?php echo $row['branch_name']?>" id="branchname" name="branchname">

<table>
 <input type="hidden" value="<?php echo $row['account_number'];?>"   id="accountnumber" name="accountnumber" autocomplete="off" READONLY > 
 <input type="hidden" value="<?php echo $row['full_name'];?>"   id="fullname" name="fullname" autocomplete="off" READONLY > 
 
  <tr>
    <td>Account Number:</td>
    <td><b><?php echo $row['account_number'];?> &nbsp <a href="amr.php"><i class="fa fa-file-text-o" style="font-size:20px;color:green"></i></b></a></td>
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
<br>
<table>
<tr>
    <td>Approval Date:</td>
    <td><input type="date" name="approvaldate" class="form-control">
    <p style="color:red;"><?php if (isset($errors['approval'])) echo $errors['approval']; ?></p></td>

    <td>Form No.:</td>
    <td><input type="text" id="formnumber" name="formnumber" autocomplete="off">
    <p style="color:red;"><?php if (isset($errors['forms'])) echo $errors['forms']; ?></p></td>
  

    <td>Patient Name:</td>
    <td><input type="text" id="patientname" name="patientname" autocomplete="off">
    <p style="color:red;"><?php if (isset($errors['patient'])) echo $errors['patient']; ?></p></td>
   
  </tr>
<tr>

    <td>Type of Membership:</td>
    <td><input type="text" id="typeofmembership" name="typeofmembership" autocomplete="off">
    <p style="color:red;"><?php if (isset($errors['membertype'])) echo $errors['membertype']; ?></p></td>

<td>Type of Claims</td>
<td><input type="text" value="<?php echo $row1['claims_classifaction']?>" name="typeofclaims" id="typesofclaims" READONLY></td>

<td>Number of Days:</td>
<td><input type="number" min="1" name="numberofdays" id="numberofdays" autocomplete="off">


</tr>
<tr>

<td>Date of Confinements</td>
<td><input type="date" name="from" class="form-control"> - <input type="date" name="to" class="form-control">
<p style="color:red;"><?php if (isset($errors['from'])) echo $errors['from']; ?></p>
<p style="color:red;"><?php if (isset($errors['to'])) echo $errors['to']; ?></p></td>



<td>KPS-Share</td>
<td><input type="number" id="kpsshare" name="kpsshare" autocomplete="off"></td>
<td>CBLIC-Share</td>
<td><input type="number" id="cblicshare" name="cblicshare" autocomplete="off"></td>

</tr>
<tr>

<td>Diagnosis</td>
<td><input type="text" id="diagnos" name="diagnos" autocomplete="off"></td>


  <td>Explanation</td>
  <td><input type="text" id="explanation" name="explanation" autocomplete="off"></td>
</tr>


</table>
<br>


<h1><input onclick="checker()" type="submit" name="submit" value="Submit"></h1>

<script>
  function checker(){

var result = confirm('DO YOU WANT TO SAVE THIS AMR FORM?');

if(result == false){

  event.preventDefault();
}
  }

</script>  



</body>
</html>




