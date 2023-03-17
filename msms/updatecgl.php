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

$sql ="SELECT * FROM member_info WHERE account_number = '$accountnumber'";
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

$sql = "SELECT * FROM cgl_data WHERE account_number = '$accountnumber'";
$cbkalinga = $con->query($sql) or die ($con->connect_error);
$row4 = $cbkalinga->fetch_assoc();



if(isset($_POST['submit'])){

  $account = $_POST['accountnumber'];
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
  $coc = $_POST['coc'];
  $lengths = $_POST['length'];
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
 

  $errors = array();

  $acc = "SELECT account_number FROM member_info WHERE account_number = '$account' ";
  $acct = mysqli_query($con,$acc);

  $dchsnum = "SELECT dchs_number FROM dchs_data WHERE dchs_number = '$dchs'";
  $dchsnumber = mysqli_query($con,$dchsnum);

  if(empty($dchs)){
    $errors['dchs'] = "DCHS Required";

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
  

    $sql = "UPDATE member_info SET account_number = '$account', full_name = '$fname', civil_status = '$civil',
    date_member = '$memdate', birth_date = '$bday', gender = '$gender', address = '$adds', product_type = '$product',
    loan_product = '$loan', date_insured = '$insured', renewal = '$renewal', branch_name ='$branch',
    coc = '$coc', length = '$lengths', unit = '$unit' WHERE account_number = '$accountnumber' ";
    $con->query($sql) or die ($con->error);

    $sql = "UPDATE cgl_data SET account_number = '$account', full_name = '$fname', b_firstname ='$bfname',
    b_lastname = '$blname', b_middlename = '$bmname', b_middleinitial = '$bminitial',b_relationship = '$brelation',
    b_birthday = '$bbdate', dchs_number = '$dchs', member_age = '$age', loan_amount = '$loanamount',
    member_duration = '$duration', date_release = '$release', expiration_date = '$expire', gross_premium = '$gross',
    net_premium = '$net', li_collected = '$li', member_livelihood = '$livelihood', explaination = '$explain'
    WHERE account_number = '$accountnumber'";
    $con->query($sql) or die ($con->error);

    $sql ="UPDATE dchs_data SET account_number = '$account', full_name = '$fname', dchs_number = '$dchs', date_insured = '$insured'
    WHERE account_number = '$accountnumber'";
     $con->query($sql) or die ($con->error);

 
  if ($con){
    echo "<script>alert('done')</script>";
  }else{ 
    echo "<script>alert('Failed')</script>";
  }

  echo header("location:cglinfo.php?AccountNumber=".$accountnumber);

}
}




?>
<!DOCTYPE html>
<html>
<head>
 <!--for icon -->

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
<h2>UPDATE CREDIT GROUP LIFE INSURANCE</h2>

<table>

  <tr>
    <td>Account Number:</td>
    <td> <input type="text" value="<?php echo $row['account_number'];?>"   id="accountnumber" name="accountnumber" autocomplete="off" READONLY ></td>
    <td>Member Name:</td>
   <td> <input type="text" value="<?php echo$row['full_name']?>" id="fullname" name="fullname"autocomplete="off"></td>
   
   <td>Civil Status:</td>         
   <td> <select id="id"  name="civilstatus">
      <option value="<?php echo $row['civil_status']?>"><?php echo $row['civil_status']?></option>
      <option value="Single">Single</option>
        <option value="Married">Married</option>
        <option value="Common Law">Common Law</option>
        <option value="Widowed">Widowed</option>
      </select>
</td>
   
  </tr>
  

  <tr>
    <td>Date of Membership:</td>
    <td><input type="date" class="form-control" value="<?php echo$row['date_member']?>"id="memberdate" name="memberdate" autocomplete="off"></td>
    <td>Date of Birth:</td>
    <td><input type="date" class="form-control" value="<?php echo$row['birth_date']?>"id="bdate" name="bdate" autocomplete="off" ></td>
    <td>Gender:</td>
    <td> <select id="id"  name="gender">
      <option value="<?php echo $row['gender']?>"><?php echo $row['gender']?></option>
      <option value="Female">Female</option>
        <option value="Male">Male</option>
      </select>
  </tr>

  <tr>
  <td>Address:</td>
    <td><input type="text" value="<?php echo$row['address']?>" id="address" name="address" autocomplete ="off"></td>  
   <td>Product Type:</td>
   <td><input type="text" value="<?php echo $row1['classification']?>"id="producttype" name="producttype" autocomplete="off" READONLY></td>
   
   <td>Loan Product: </td>
<td> <select id="id"  name="loanproduct">
      <option value="<?php echo $row['loan_product']?>"><?php echo $row['loan_product']?></option>
  <?php do{?>
      <option value="<?php echo$row3['product_name']?>"><?php echo$row3['product_name']?></option>
      <?php } while ($row3 = $productinfo->fetch_assoc())?>
      </select>
</td>

</tr>

</table>
<br>
<br>
<table>

<tr>

<td>Date Insured:</td>
<td><input type ="date" value= "<?php echo $row['date_insured']?>" name="dateinsured" class="form-control">
<p style="color:red;"><?php if (isset($errors['di'])) echo $errors['di'];?></p></td>

<td>Renewal Date:</td>
<td><input type="date" value="<?php echo$row['renewal']?>" name="renewaldate" class="form-control">
<p style="color:red;"><?php if(isset($errors['rd'])) echo $errors['rd'];?></p></td>

<td>Branch Name:</td>
<td> <select id="id" name="branchname">
  <option value="<?php echo$row['branch_name']?>"><?php echo $row['branch_name']?></option>
  <?php do{?>
      <option value="<?php echo$row2['branch_name']?>"><?php echo$row2['branch_name']?></option>
      <?php } while ($row2 = $kpsbranches->fetch_assoc())?>
      </select>
</td>

</tr>


<tr>
  <td>Coverage of Confirmation:</td>
  <td><input type ="text" value="<?php echo$row['coc']?>" id="coc" name="coc" autocomplete="off">
  <p style="color:red;"><?php if(isset($errors['c'])) echo $errors['c']; ?></p></td>

  <td>Length of Membership:</td>
  <td><input type ="number" value="<?php echo$row['length']?>" id="length" name="length" min="1" max="99" autocomplete="off">
  <p style="color:red;"> <?php if(isset($errors['l'])) echo $errors['l']?> </p></td>
  <td>Number of Units:</td>
  <td><input type="number" value="<?php echo$row['unit']?>" id="nou" name="nou" min="1" max="6" autocomplete="off">
  <p style="color:red;"> <?php if(isset($errors['u'])) echo $errors['u']?></p></td>

</tr>
</table>

<table>
<h2>BENEFICIARY</h2>
<tr>
<td>First Name:</td>
<td><input type="text" value="<?php echo $row4['b_firstname']?>" id="bfirstname" name="bfirstname" autocomplete="off">
<p style="color:red;"><?php if(isset($errors['bf'])) echo $errors['bf']?></p> </td>

<td>Middle Name:</td>
<td><input type="text" value="<?php echo $row4['b_middlename']?>" id="bmiddlename" name="bmiddlename" autocomplete="off">
<p style ="color:red;"><?php if(isset($errors['bm'])) echo $errors['bm']?></p>  </td>
<td>Last Name:</td>
<td><input type="text" value ="<?php echo $row4['b_lastname']?>" id="blastname" name="blastname" autocomplete="off">
<p style="color:red;"> <?php if(isset($errors['bl'])) echo $errors['bl']?></p> </td>
</tr>

<tr>
  <td>Middle Initial:</td>
  <td><input type="text" value="<?php echo $row4['b_middleinitial']?>" id="bmiddileinitial" name="bmiddleinitial" autocomplete="off">
  <p style = "color:red;"><?php if(isset($errors['bi'])) echo $errors['bi']?></p></td>

  <td>Relationship:</td>
  <td><input type="text" value="<?php echo $row4['b_relationship']?>" id="brelationship" name="brelationship" autocomplete="off">
  <p style="color:red;"> <?php if(isset($errors['br'])) echo $errors['br']?></p> </td>
  <td>Birthdate:</td>
  <td><input type="date" value="<?php echo $row4['b_birthday']?>" name="bbirthdate" class="form-control">
 
</tr>

</table>

<table>
  <h2>CREDIT GROUP LIFE INFORMATION </h2>

  <tr>
<td>DCHS NUMBER:</td>
<td><input type="number" value = "<?php echo$row4['dchs_number']?>" id="dchsnumber" name="dchsnumber" autocomplete="off" >
<p style="color:red;"><?php if (isset($errors['dchs'])) echo $errors['dchs']; ?></p></td>
<td>Member Age:</td>
<td><input type="number" value="<?php echo$row4['member_age']?>" id="memberage" name="memberage" min="1"  autocomplete="off"></td>
<td>Loan Amount:</td>
<td><input type="number" value="<?php echo $row4['loan_amount']?>" id="loanamount" name="loanamount" min="1" autocomplete="off" ></td>
<td>Duration:</td>
<td><input type="number" value="<?php echo $row4['member_duration']?>" min="1"  id="duration" name="duration"  autocomplete="off">
<p style="color:red;"><?php if (isset($errors['dur'])) echo $errors['dur']; ?></p></td>
</tr>

<tr>
<td>Date of Release:</td>
<td><input type="date"value="<?php echo$row4['date_release']?>" name="daterelease" class="form-control"></td>
<td>Expiration Date:</td>
<td><input type="date" value="<?php echo $row4['expiration_date']?>" name="expirationdate" class="form-control"></td>
<td>Gross Premium:</td>
<td><input type="number" value="<?php echo $row4['gross_premium']?>" id="grosspremium" name="grosspremium" min="1" autocomplete="off"></td>
<td>Net Premium:</td>
<td><input type="number" value=<?php echo $row4['net_premium']?> id="netpremium" name="netpremium" min="1" autocomplete="off"></td>
</tr>

<tr>
  <td>Loan Insurance Collected:</td>
  <td><input type="number" value="<?php echo $row4['li_collected']?>" id="licollected" name="licollected"  min="1" autocomplete="off"></td>
  <td>Livelihood</td>
  <td><input type="text"value="<?php echo $row4['member_livelihood']?>" id="memberlivelihood" name="memberlivelihood" autocomplete="off"></td>
 


</tr>

</table>

<br>
<table>
  <tr>
  <td>Explaination</td>
  <td><input type="text"value="<?php echo $row4['explaination']?>" id="explain"  name="explain"  size="165" autocomplete="off"></td>
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




