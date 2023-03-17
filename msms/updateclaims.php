<?php 
if (!isset($_SESSION)){

    session_start();
}

if(!isset($_SESSION['Access'])){
  header("Location: login.php");
}


include_once("connections/connection.php");
$con = connection();


$codenumber = $_GET["CODE"];


$sql = "SELECT * FROM claims_file WHERE form_code = '$codenumber'";
$claimsfile = $con->query($sql) or die ($con->connect_error);
$row1 = $claimsfile->fetch_assoc();

$accountnumber = $row1['account_number'];

if(isset($_POST['submit'])){

    $account = $_POST['accountnumber'];
    $fname = $_POST['fullname'];
    $approval = $_POST['approvaldate'];
    $patient = $_POST['patientname'];
    $membertype = $_POST['typeofmembership'];
    $claimtype = $_POST['typeofclaims'];

    if($row1['claims_type'] == "DCB"|| $row1['claims_type'] == "AMR") {
    $days = $_POST['numberofdays'];
    $from = $_POST['from'];
    $to  = $_POST['to'];
    }

    $kps = $_POST['kpsshare'];
    $cblic = $_POST['cblicshare'];
    $diagnos = $_POST['diagnos'];
    $explain = $_POST['explanation'];
    $form = $_POST['formnumber'];
  
    if($row1['claims_type'] == "IA"|| $row1['claims_type'] == "NDC" || $row1['claims_type'] == "ADC") {
    $death = $_POST['dateofdeath'];
    }

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
  if($row1['claims_type'] == "DCB"|| $row1['claims_type'] == "AMR") {
  if(empty($days)){
    $errors['days'] = "Number of Days Required";
  }

  if(empty($from)){ 
    $errors['from'] = "From Date of Confinements Required";
  }

  if(empty($to)){
    $errors['to'] = " Date of Confinements Required";
  }
}
 if($row1['claims_type'] == "IA"|| $row1['claims_type'] == "NDC" || $row1['claims_type'] == "ADC") {
  if (empty($death)){
    $errors ['death'] = "Date of Death Required";
  }
}


if($row1['claims_type'] == "IA"|| $row1['claims_type'] == "NDC" || $row1['claims_type'] == "ADC" || $row1['claims_type'] == "DCB"|| $row1['claims_type'] == "AMR") {
  if (empty($diagnos)){
    $errors ['diagnos'] = "Diagnos Required";
  }
}

  



  if (count($errors)==0){

$sql = "UPDATE claims_file SET account_number = '$account', full_name = '$fname', approval_date = '$approval',
form_number = '$form', patient_name = '$patient', membership_type = '$membertype', claims_type = '$claimtype',
days_number = '$days', from_confinement = '$from', to_confinement = '$to', kps_share = '$kps',
cblic_share = '$cblic', member_diagnos = '$diagnos', member_explanation = '$explain', death_date = '$death'
WHERE form_code = '$codenumber'";
$con->query($sql) or die ($con->error);    

$sql1 ="UPDATE formnumber_data SET account_number = '$account', full_name = '$fname', form_number = '$form',
claims_type = '$claimtype', approval_date = '$approval', patient_name = '$patient'
WHERE form_code = '$codenumber'";
$con->query($sql1) or die ($con->error);    


  if ($con){
    echo "<script>alert('done')</script>";
  }else{ 
    echo "<script>alert('Failed')</script>";
  }



echo header("location: claimsdetails.php?AccountNumber=".$accountnumber);
}
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

<title>MICRO SEGURO MANAGEMENT</title>
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
<li><button onclick="history.back()"><i class="fa fa-caret-square-o-left" style="font-size:24px;color:green"></a></i></li>


</ul>
<form action="" method="post">
<h2>UPDATE CLAIMS </h2>

<table>
  <tr>
    <td>Account Number:</td>
    <td><input type="text" value="<?php echo $row1['account_number'];?>" name="accountnumber" id = "accountnumber" READONLY > </td>
    <td>Member Name:</td>
   <td><input type ="text"value ="<?php echo$row1['full_name'];?>"name="fullname" id="fullname" READONLY></td>
   
</table>
<br>
<br>
<table>
<tr>
    <td>Approval Date:</td>
    <td><input type="date" value="<?php echo $row1['approval_date']?>" name="approvaldate" class="form-control">
    <p style="color:red;"><?php if (isset($errors['approval'])) echo $errors['approval']; ?></p></td>

    <td>Form No.:</td>
    <td><input type="text" value="<?php echo $row1['form_number']?>" id="formnumber" name="formnumber" autocomplete="off">
    <p style="color:red;"><?php if (isset($errors['forms'])) echo $errors['forms']; ?></p></td>

    <td>Patient Name:</td>
    <td><input type="text" value="<?php echo $row1['patient_name']?>" id="patientname" name="patientname" autocomplete="off">
    <p style="color:red;"><?php if (isset($errors['patient'])) echo $errors['patient']; ?></p></td>
    </tr>

<tr>
    
    <td>Type of Membership:</td>
    <td><input type="text" value="<?php echo $row1['membership_type']?>" id="typeofmembership" name="typeofmembership" autocomplete="off">
    <p style="color:red;"><?php if (isset($errors['membertype'])) echo $errors['membertype']; ?></p></td>

<td>Type of Claims</td>
<td><input type="text" value="<?php echo $row1['claims_type']?>" name="typeofclaims" id="typesofclaims" READONLY></td>


<?php  if($row1['claims_type'] == "DCB"|| $row1['claims_type'] == "AMR") {?>
<td>Number of Days:</td>
<td><input type="number" value="<?php echo $row1['days_number']?>" min ="1" name="numberofdays" id="numberofdays" autocomplete="off">
<p style="color:red;"><?php if (isset($errors['days'])) echo $errors['days']; ?></p></td>

</tr>
<tr>

<td>Date of Confinements</td>
<td><input type="date" value="<?php echo $row1['from_confinement']?>" name="from" class="form-control"> - <input type="date" value="<?php echo $row1['to_confinement']?>" name="to" class="form-control">
<p style="color:red;"><?php if (isset($errors['from'])) echo $errors['from']; ?></p>
<p style="color:red;"><?php if (isset($errors['to'])) echo $errors['to']; ?></p></td>
<?php } ?>

<td>KPS-Share</td>
<td><input type="number" value="<?php echo $row1['kps_share']?>" id="kpsshare" name="kpsshare" autocomplete="off"></td>
<td>CBLIC-Share</td>
<td><input type="number" value="<?php echo $row1['cblic_share']?>" id="cblicshare" name="cblicshare" autocomplete="off"></td>

</tr>

<tr>
<?php if($row1['claims_type'] == "IA"|| $row1['claims_type'] == "NDC" || $row1['claims_type'] == "ADC" || $row1['claims_type'] == "DCB"|| $row1['claims_type'] == "AMR") {?>
<td>Diagnosis</td>
<td><input type="text" value="<?php echo $row1['member_diagnos']?>" id="diagnos" name="diagnos" autocomplete="off">
<p style="color:red;"><?php if (isset($errors['diagnos'])) echo $errors['diagnos']; ?></p></td>
<?php } ?>

<?php   if($row1['claims_type'] == "IA"|| $row1['claims_type'] == "NDC" || $row1['claims_type'] == "ADC") {?>
<td>Date of Death</td>
<td><input type="date" value="<?php echo $row1['death_date']?>" name="dateofdeath" class="form-control">
<p style="color:red;"><?php if (isset($errors['death'])) echo $errors['death']; ?></p>

<?php }?>


  <td>Explanation:</td>
  <td><input type="text" value="<?php echo $row1['member_explanation']?>" id ="explanation" name="explanation" autocomplete="off"></td>
</tr>

</table>
<br>


<h1><input onclick="checker()" type="submit" name="submit" value="Submit"></h1>

<script>

function checker(){

  var result = confirm('DO YOU WANT TO SAVE THIS CHANGES?');

  if(result == false){

    event.preventDefault();
  }

}

  </script>



</body>
</html>




