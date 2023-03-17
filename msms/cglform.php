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

  $account = $_POST['accountnumber'].'-'.$_POST['productid'].'-'.$_POST['cycle'];
  $fname = $_POST['fullname'];
  $civil = $_POST['civilstatus'];
  $memdate = $_POST['memberdate'];
  $bday = $_POST['bdate'];
  $gender = $_POST['gender'];
  $adds = $_POST['address'];
  $product = $_POST['producttype'];
  $insured = $_POST['dateinsured'];
  $renewal = $_POST['renewaldate'];
  $branch = $_POST['branchname'];
  $loan = $_POST['loanproduct'];
  $status = $_POST['loanstatus'];
  $coc = $_POST['coc'];
  $lengths = $_POST['length'].' '.$_POST['dyoflength'];
  $unit = $_POST['nou'];

  $bfname = $_POST['bfirstname'];
  $bmname = $_POST['bmiddlename'];
  $blname = $_POST['blastname'];
  $bminitial = $_POST['bmiddleinitial'];
  $brelation = $_POST['brelationship'];
  $bbdate = $_POST['bbirthdate'];

  $dchs = $_POST['dchsnumber'];
  $age = $_POST['memberage'];
  $loanamount = $_POST['loanamount'];
  $duration = $_POST['duration'];
  $release = $_POST['daterelease'];
  $expire = $_POST['expirationdate'];
  $gross = $_POST['grosspremium'];
  $net  = $_POST['netpremium'];
  $li = $_POST['licollected'];
  $livelihood = $_POST['memberlivelihood'];
  $explain = $_POST['explain'];
  $cycles = $_POST['cycle'];
  $accountstatus = $_POST['accountstatus'];

  $errors = array();

  $acc = "SELECT account_number FROM member_info WHERE account_number = '$account' ";
  $acct = mysqli_query($con,$acc);

  $dchsnum = "SELECT dchs_number FROM dchs_data WHERE dchs_number = '$dchs'";
  $dchsnumber = mysqli_query($con,$dchsnum);

  if (empty($account)){
    $errors['cycles'] = "Cycle Required";
  }else if (mysqli_num_rows($acct)>0){
    $errors['cycles'] = "Account Number Cycle exist";
  }

  if(empty($dchs)){
    $errors['dchs'] = "DCHS Required";
  }else if (mysqli_num_rows($dchsnumber)>0){
    $errors['dchs'] = "DCHS Number Exist";
  }

  if(empty($cycles)){
    $errors['cycles'] = "Account Number Cycle Required";
  }

  if(empty($insured)){
    $errors['di'] = "Date Insured Required";
  }
  
  if(empty($renewal)){
    $errors['rd'] = "Renewal Date Required";
  }

  if(empty($coc)){ 
    $errors['c'] = "Coverage of Confirmation";
  }

  if(empty($lengths)){
    $errors['l'] = "Length of Membership Required";
  }

  if(empty($unit)){
    $errors['u'] = "No. Of Units Required";
  }

if(empty($bfname)){
  $errors['bf'] = "First Name Required";
}

if(empty($bmname)){
  $errors['bm'] = "Middle Name Required";
}

if(empty($blname)){
  $errors['bl'] = "Last Name Required";
}

if(empty($bminitial)){
  $errors['bi'] = "Middle Initial Required";
}

if(empty($brelation)){
  $errors['br'] ="Relationship Required";
}

if(empty($bbdate)){
  $errors['bd'] = "Birthdate Required";
}
if(empty($duration)){
$errors['dur'] = "Duration Required";

}








  if (count($errors)==0){
  



  $sql ="INSERT INTO `member_info`(`account_number`,`full_name`,`civil_status`,`date_member`,`birth_date`,`gender`,`address`,`product_type`,
  `date_insured`,`renewal`,`branch_name`,`loan_product`,`loan_status`,`coc`,`length`,`unit`,`Status`)
  VALUES ('$account','$fname','$civil','$memdate','$bday','$gender','$adds','$product','$insured','$renewal','$branch',
  '$loan','$status','$coc','$lengths','$unit','$accountstatus')";
$con->query($sql) or die ($con->error);

$sql = "INSERT INTO `cgl_data`(`account_number`,`full_name`,`b_firstname`,`b_lastname`,`b_middlename`,`b_middleinitial`,`b_relationship`,`b_birthday`,
`dchs_number`,`member_age`,`loan_amount`,`member_duration`,`date_release`,`expiration_date`,`gross_premium`,`net_premium`,`li_collected`,`member_livelihood`,`explaination`,`Status`)
 VALUES('$account','$fname','$bfname','$blname','$bmname','$bminitial','$brelation','$bbdate','$dchs','$age',
 '$loanamount','$duration','$release','$expire','$gross','$net','$li','$livelihood','$explain','$accountstatus')";
$con->query($sql) or die ($con->error);

$sql = "INSERT INTO `dchs_data`(`account_number`,`full_name`,`dchs_number`,`date_insured`)
VALUES ('$account','$fname','$dchs', '$insured')";
$con->query($sql) or die ($con->error);

  if ($con){
    echo "<script>alert('done')</script>";
  }else{ 
    echo "<script>alert('Failed')</script>";
  }

echo header ("location:memberinfo.php?Accountnumber=".$accountnumber);

}
}

$sql ="SELECT * FROM member_account WHERE account_number = '$accountnumber'";
$memberproduct = $con->query($sql) or die ($con->connect_error);
$row = $memberproduct->fetch_assoc();

$sql="SELECT * FROM insurance_product WHERE product_id = '006' ";
$insuranceproduct = $con->query($sql) or die (con->connect_error);
$row1 = $insuranceproduct->fetch_assoc(); 

$sql = "SELECT * FROM kps_branches ORDER BY branch_account";
$kpsbranches = $con->query($sql) or die ($con->connect_error);
$row2 = $kpsbranches->fetch_assoc();

$sql = "SELECT * FROM product_info ORDER BY product_id";
$productinfo = $con->query($sql) or die ($con->connect_error);
$row3 = $productinfo->fetch_assoc();  





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
  <li><a href="memberselect.php"><i class="fa fa-caret-square-o-left" style="font-size:24px;color:green"></a></i></li>


</ul>
<form action="" method="post">
<h2>CREDIT GROUP LIFE INSURANCE</h2>



<input type="hidden" id="accountstatus" name ="accountstatus" value="Active">
<table>

  <tr>
    <td>Account Number:</td>
    <td> <input type="text" value="<?php echo $row['account_number'];?>"   id="accountnumber" name="accountnumber" autocomplete="off" READONLY > <a href="cgl.php"><i class="fa fa-file-text-o" style="font-size:20px;color:green"></i></a></td>
    <td>Member Name:</td>
   <td> <input type="text" value="<?php echo$row['last_name'],',  ',$row['first_name'],'  ',$row['middle_initial']?>" id="fullname" name="fullname"autocomplete="off" READONLY ></td>
   <td>Civil Status:</td>         
   <td> <input type="text" value="<?php echo$row['civil_status']?>" id="civilstatus" name="civilstatus" autocomplete="off" READONLY ></td>
   
  </tr>
  

  <tr>
    <td>Date of Membership:</td>
    <td><input type="text" value="<?php echo$row['date_member']?>"id="memberdate" name="memberdate" autocomplete="off"READONLY></td>
    <td>Date of Birth:</td>
    <td><input type="text" value="<?php echo$row['birth_date']?>"id="bdate" name="bdate" autocomplete="off" READONLY></td>
    <td>Gender:</td>
    <td><input type="text" value="<?php echo$row['gender']?>" id="gender" name="gender" autocomplete ="off" READONLY></td>  
  </tr>

  <tr>
  <td>Address:</td>
    <td><input type="text" value="<?php echo$row['member_address']?>" id="address" name="address" autocomplete ="off" READONLY></td>  
   <td>Product Type:</td>
   <td><input type="text" value="<?php echo $row1['classification']?>"id="producttype" name="producttype" autocomplete="off" READONLY></td>
   <input type="hidden" value="<?php echo $row1['product_id']?>"id="productid" name="productid" autocomplete="off">
</tr>

</table>
<br>
<br>
<table>

<tr>
<td>Cycle:</td>
<td><input type="number" id="cycle" name="cycle" min="1" autocomplete="off">
<p style="color:red;"><?php if (isset($errors['cycles'])) echo $errors['cycles']; ?></p></td>

<td>Date Insured:</td>
<td><input type ="date" name="dateinsured" class="form-control">
<p style="color:red;"><?php if (isset($errors['di'])) echo $errors['di'];?></p></td>

<td>Renewal Date:</td>
<td><input type="date" name="renewaldate" class="form-control">
<p style="color:red;"><?php if(isset($errors['rd'])) echo $errors['rd'];?></p></td>
</tr>

<tr>
<td>Branch Name:</td>
<td> <select id="id" name="branchname">
  <?php do{?>
      <option value="<?php echo$row2['branch_name']?>"><?php echo$row2['branch_name']?></option>
      <?php } while ($row2 = $kpsbranches->fetch_assoc())?>
      </select>
</td>


<td>Loan Product: </td>
<td> <select id="id" name="loanproduct">
  <?php do{?>
      <option value="<?php echo$row3['product_name']?>"><?php echo$row3['product_name']?></option>
      <?php } while ($row3 = $productinfo->fetch_assoc())?>
      </select>
</td>
<td>Loan Status:</td>
<td> <select id="id" name="loanstatus">
        <option value="Active">Active</option>
        <option value="Savers">Savers</option>
        <option value="PAR">PAR</option>
        <option value="Offset">Offset</option>
       
      </select>
</td>
</tr>


<tr>
  <td>Coverage of Confirmation:</td>
  <td><input type ="text" id="coc" name="coc" autocomplete="off">
  <p style="color:red;"><?php if(isset($errors['c'])) echo $errors['c']; ?></p></td>

  <td>Length of Membership:</td>
  <td><input type ="number" id="length" name="length" min="1" max="99"   autocomplete="off"> 
      <select id="id" name="dyoflength">
        <option value="Day">Day</option>
        <option value="Years">Years</option>
      </select>
  <p style="color:red;"> <?php if(isset($errors['l'])) echo $errors['l']?> </p></td>
  
  
  <td>Number of Units:</td>
  <td><input type="number" id="nou" name="nou" min="1" max="6" autocomplete="off">
  <p style="color:red;"> <?php if(isset($errors['u'])) echo $errors['u']?></p></td>

</tr>
</table>

<table>
<h2>BENEFICIARY</h2>
<tr>
<td>First Name:</td>
<td><input type="text" id="bfirstname" name="bfirstname" autocomplete="off">
<p style="color:red;"><?php if(isset($errors['bf'])) echo $errors['bf']?></p> </td>

<td>Middle Name:</td>
<td><input type="text" id="bmiddlename" name="bmiddlename" autocomplete="off">
<p style ="color:red;"><?php if(isset($errors['bm'])) echo $errors['bm']?></p>  </td>
<td>Last Name:</td>
<td><input type="text" id="blastname" name="blastname" autocomplete="off">
<p style="color:red;"> <?php if(isset($errors['bl'])) echo $errors['bl']?></p> </td>
</tr>

<tr>
  <td>Middle Initial:</td>
  <td><input type="text" id="bmiddileinitial" name="bmiddleinitial" autocomplete="off">
  <p style = "color:red;"><?php if(isset($errors['bi'])) echo $errors['bi']?></p></td>

  <td>Relationship:</td>
  <td><input type="text" id="brelationship" name="brelationship" autocomplete="off">
  <p style="color:red;"> <?php if(isset($errors['br'])) echo $errors['br']?></p> </td>
  <td>Birthdate:</td>
  <td><input type="date" name="bbirthdate" class="form-control">
  <p style="color:red;"> <?php if(isset($errors['bd'])) echo $errors['bd']?></p> </td>
</tr>

</table>

<table>
  <h2>CREDIT GROUP LIFE INFORMATION </h2>

  <tr>
<td>DCHS NUMBER:</td>
<td><input type="number" id="dchsnumber" name="dchsnumber" autocomplete="off">
<p style="color:red;"><?php if (isset($errors['dchs'])) echo $errors['dchs']; ?></p></td>

<td>Member Age:</td>
<td><input type="number" id="memberage" name="memberage" min="1" autocomplete="off"></td>
<td>Loan Amount:</td>
<td><input type="number" id="loanamount" name="loanamount" min="1" autocomplete="off"></td>
<td>Duration:</td>
<td><input type="number" id="duration" min="1" name="duration"  autocomplete="off">
<p style="color:red;"><?php if (isset($errors['dur'])) echo $errors['dur']; ?></p></td>
</tr>

<tr>
<td>Date of Release:</td>
<td><input type="date" name="daterelease" class="form-control"></td>
<td>Expiration Date:</td>
<td><input type="date" name="expirationdate" class="form-control"></td>
<td>Gross Premium:</td>
<td><input type="number" id="grosspremium" name="grosspremium" min="1" autocomplete="off"></td>
<td>Net Premium:</td>
<td><input type="number" id="netpremium" name="netpremium" min="1" autocomplete="off"></td>
</tr>

<tr>
  <td>Loan Insurance Collected:</td>
  <td><input type="number" id="licollected" name="licollected"  min="1" autocomplete="off"></td>
  <td>Livelihood</td>
  <td><input type="text" id="memberlivelihood" name="memberlivelihood" autocomplete="off"></td>
 


</tr>

</table>

<br>
<table>
  <tr>
  <td>Explaination</td>
  <td><input type="text" id="explain"  name="explain"  size="165" autocomplete="off"></td>
  </tr>
  </table>


<br>


<h1><input onclick="checker()" type="submit" name="submit" value="Submit"></h1>


<script>

function checker(){

var result = confirm('DO YOU WANT TO SAVE THIS FORM ? ');

if(result == false){

  event.preventDefault();
}

}

</script>  


</body>
</html>




