<?php 
if (!isset($_SESSION)){

    session_start();
}

if(!isset($_SESSION['Access'])){
  header("Location: login.php");
}


include_once("connections/connection.php");
$con = connection();


if(isset($_GET['submits'])){


  $accountnumber = $_GET["AccountNumber"];

$from_date = $_GET['from'];
$to_date = $_GET['to'];
$branchname = $_GET['branch'];



$sql ="SELECT * FROM member_info WHERE account_number = '$accountnumber'";
$memberproduct = $con->query($sql) or die ($con->connect_error);
$row = $memberproduct->fetch_assoc();



$sql = "SELECT * FROM kps_branches ORDER BY branch_account";
$kpsbranches = $con->query($sql) or die ($con->connect_error);
$row2 = $kpsbranches->fetch_assoc();

$sql = "SELECT * FROM product_info ORDER BY product_id";
$productinfo = $con->query($sql) or die ($con->connect_error);
$row3 = $productinfo->fetch_assoc();  

$sql5 ="SELECT * FROM membership_info ORDER BY membership_id";
$membershipinfo = $con->query($sql5) or die ($con->connect_error);
$row5 = $membershipinfo->fetch_assoc();




if($row['product_type'] == "CBK-Member"|| $row['product_type'] == "CBK-Pension" || $row['product_type'] == "ASB-Family" || $row['product_type']== "ASB-Individual" || $row['product_type']=="ASB-Senior"){
$sql = "SELECT * FROM cb_kalinga WHERE account_number = '$accountnumber'";
$cbkalinga = $con->query($sql) or die ($con->connect_error);
$row4 = $cbkalinga->fetch_assoc();
}else{
$sql = "SELECT * FROM cgl_data WHERE account_number = '$accountnumber'";
$cgldata = $con->query($sql) or die ($con->connect_error);
$row4 = $cgldata->fetch_assoc();
}


$codes = 1 ;

$dateinsured = $row['date_insured'];
$renewaldate = $row['renewal'];
}




$addinsured = date('Y-m-d', strtotime($dateinsured.'+1 years'));
$addrenewal = date('Y-m-d', strtotime($renewaldate.'+1 years'));







if(isset($_POST['submit'])){

  $account = $_POST['accountnumber'] ;
  $fname = $_POST['fullname'];
  $civil = $_POST['civilstatus'];
  $memdate = $_POST['memberdate'];
  $bday = $_POST['bdate'];
  $gender = $_POST['gender'];
  $adds = $_POST['address'];
  $product = $_POST['producttype'];

  $insured = $_POST['dateinsured'];
  $renewal = $_POST['renewaldate'];
  $msinfo = $_POST['memstatus'];


  $branch = $_POST['branchname'];
  $loan = $_POST['loanproduct'];

  $coc = $_POST['coc'];
  $lengths = $_POST['length'] + $codes;
  $dayoflength = 'Years';
  $unit = $_POST['nou'];
  $status = $_POST['loanstatus'];

  $bfname = $_POST['bfirstname'];
  $bmname = $_POST['bmiddlename'];
  $blname = $_POST['blastname'];
  $bminitial = $_POST['bmiddleinitial'];
  $brelation = $_POST['brelationship'];
  $bbdate = $_POST['bbirthdate'];

  if($row['product_type'] == "CBK-Member"|| $row['product_type'] == "CBK-Pension" || $row['product_type'] == "ASB-Family"){
  $mfname = $_POST['mfirstname'];
  $mmname = $_POST['mmiddlename'];
  $mlname = $_POST['mlastname'];
  $mbdate = $_POST['mbirthdate'];
  $c1fname = $_POST['c1firstname'];
  $c1mname = $_POST['c1middlename'];
  $c1lname = $_POST['c1lastname'];
  $c1bdate = $_POST['c1birthdate'];
  $c2fname = $_POST['c2firstname'];
  $c2mname = $_POST['c2middlename'];
  $c2lname = $_POST['c2lastname'];
  $c2bdate = $_POST['c2birthdate'];
  $c3fname = $_POST['c3firstname'];
  $c3mname = $_POST['c3middlename'];
  $c3lname = $_POST['c3lastname'];
  $c3bdate = $_POST['c3birthdate'];
  $a1fname = $_POST['a1firstname'];
  $a1mname = $_POST['a1middlename'];
  $a1lname = $_POST['a1lastname'];
  $a1relation = $_POST['a1relationship'];
  $a1bdate = $_POST['a1birthdate'];
  $a2fname = $_POST['a2firstname'];
  $a2mname = $_POST['a2middlename'];
  $a2lname = $_POST['a2lastname'];
  $a2relation = $_POST['a2relationship'];
  $a2bdate = $_POST['a2birthdate'];
  $a3fname = $_POST['a3firstname'];
  $a3mname = $_POST['a3middlename'];
  $a3lname = $_POST['a3lastname'];
  $a3relation = $_POST['a3relationship'];
  $a3bdate = $_POST['a3birthdate'];
  $a4fname = $_POST['a4firstname'];
  $a4mname = $_POST['a4middlename'];
  $a4lname = $_POST['a4lastname'];
  $a4relation = $_POST['a4relationship'];
  $a4bdate = $_POST['a4birthdate'];
  $nocb = $_POST['nocb'];

  }
  
  $accountstatus = $_POST['accountstatus'];
  $updatestatus = $_POST['updatestatus'];
  


  $errors = array();

  $acc = "SELECT account_number FROM member_info WHERE account_number = '$account' ";
  $acct = mysqli_query($con,$acc);

  if (empty($account)){
    $errors['cycles'] = "Cycle Required";
  }else if (mysqli_num_rows($acct)>0){
    $errors['cycles'] = "Account Number Cycle exist";
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




  if (count($errors)==0){

    $sql5 ="UPDATE member_info SET Status = '$updatestatus' WHERE account_number = '$accountnumber' ";
    $con->query($sql5) or die ($con->error);

    $sql6 ="UPDATE cb_kalinga SET Status = '$updatestatus' WHERE account_number = '$accountnumber' ";
    $con->query($sql6) or die ($con->error);

    $cb = "UPDATE cb_form SET cb_status = '$updatestatus' WHERE account_number = '$accountnumber'";
    $con->query($cb) or die ($con->error);
 
    if($row['product_type'] == "ASB-Senior"||$row['product_type'] == "ASB-Individual"){ 


      $sql  ="INSERT INTO `member_info`(`account_number`,`full_name`,`civil_status`,`date_member`,`birth_date`,`gender`,`address`,`product_type`,
      `date_insured`,`renewal`,`branch_name`,`loan_product`,`loan_status`,`coc`,`length`,`dayoflength`,`unit`,`Status`)
      VALUES ('$account','$fname','$civil','$memdate','$bday','$gender','$adds','$product','$insured','$renewal','$branch',
      '$loan','$status','$coc','$lengths','$dayoflength','$unit','$accountstatus')";
      $con->query($sql) or die ($con->error);


      $sqlkalinga = "INSERT INTO `cb_kalinga`(`account_number`,`full_name`,`b_firstname`,`b_lastname`,`b_middlename`,`b_middleinitial`,`b_relationship`,`b_birthday`,`Status`)
      VALUES('$account','$fname','$bfname','$blname','$bmname','$bminitial','$brelation','$bbdate','$accountstatus')";
      $con->query($sqlkalinga) or die ($con->error);

    

         
      if ($con){
        echo "<script>alert('done')</script>";
      }else{ 
        echo "<script>alert('Failed')</script>";
      }
    
      echo header("location: renewal.php"."?from_date=".$from_date."&to_date=".$to_date."&branchname=".$branchname); 
   
      

    }else {


  $sql  ="INSERT INTO `member_info`(`account_number`,`full_name`,`civil_status`,`date_member`,`birth_date`,`gender`,`address`,`product_type`,
  `number_cb`,`membership_status`,`date_insured`,`renewal`,`branch_name`,`loan_product`,`loan_status`,`coc`,`length`,`dayoflength`,`unit`,`Status`)
  VALUES ('$account','$fname','$civil','$memdate','$bday','$gender','$adds','$product','$nocb','$msinfo','$insured','$renewal','$branch',
  '$loan','$status','$coc','$lengths','$dayoflength','$unit','$accountstatus')";
  $con->query($sql) or die ($con->error);
  
  $sql = "INSERT INTO `cb_kalinga`(`account_number`,`full_name`,`b_firstname`,`b_lastname`,`b_middlename`,`b_middleinitial`,`b_relationship`,`b_birthday`,
  `m_firstname`,`m_lastname`,`m_middlename`,`m_birthday`,`c1_firstname`,`c1_lastname`,`c1_middlename`,`c1_birthday`,`c2_firstname`,
  `c2_lastname`,`c2_middlename`,`c2_birthday`,`c3_firstname`,`c3_lastname`,`c3_middlename`,`c3_birthday`,`a1_firstname`,`a1_lastname`,`a1_middlename`,
  `a1_birthday`,`a1_relationship`,`a2_firstname`,`a2_lastname`,`a2_middlename`,`a2_birthday`,`a2_relationship`,`a3_firstname`,`a3_lastname`,
  `a3_middlename`,`a3_birthday`,`a3_relationship`,`a4_firstname`,`a4_lastname`,`a4_middlename`,`a4_birthday`,`a4_relationship`,`Status`)
   VALUES('$account','$fname','$bfname','$blname','$bmname','$bminitial','$brelation','$bbdate','$mfname',
    '$mlname','$mmname','$mbdate','$c1fname','$c1lname','$c1mname','$c1bdate','$c2fname','$c2lname','$c2mname','$c2bdate','$c3fname','$c3lname',
    '$c3mname','$c3bdate','$a1fname','$a1lname','$a1mname','$a1bdate','$a1relation','$a2fname','$a2lname','$a2mname','$a2bdate','$a2relation',
    '$a3fname','$a3lname','$a3mname','$a3bdate','$a3relation','$a4fname','$a4lname','$a4mname','$a4bdate','$a4relation','$accountstatus')";
  $con->query($sql) or die ($con->error);
  

  $sql3 ="INSERT INTO `cb_form`(`account_number`,`full_name`,`cb_number`,`date_insured`,`cb_status`) VALUES ('$account','$fname','$nocb','$insured','$accountstatus')";
  $con->query($sql3) or die ($con->error);

  if ($con){
    echo "<script>alert('done')</script>";
  }else{ 
    echo "<script>alert('Failed')</script>";
  }

  echo header("location: renewal.php"."?from_date=".$from_date."&to_date=".$to_date."&branchname=".$branchname); 
   

}
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
  <li><a href="renewal.php?<?php echo "from_date=".$from_date."&to_date=".$to_date."&branchname=".$branchname?>"><i class="fa fa-caret-square-o-left" style="font-size:24px;color:green"></a></i></li>


</ul>
<form action="" method="post">
<h2>MEMBER RENEWAL </h2>










<input type="hidden" id="accountstatus" name ="accountstatus" value="Active">
<input type="hidden" id="updatestatus" name = "updatestatus" value="Renewed">

<table>

  <tr>
    <td>Account Number:</td>
    <td> <input type="text" value="<?php echo $row['account_number'];?>"   id="accountnumber" name="accountnumber" autocomplete="off"  >
    <p style="color:red;"><?php if (isset($errors['cycles'])) echo $errors['cycles']; ?></p></td>

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
  </tr>
  
  

  <tr>
    <td>Date of Membership:</td>
    <td><input type="date" class="form-control" value="<?php echo$row['date_member']?>"id="memberdate" name="memberdate" autocomplete="off" READONLY></td>
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
   <td><input type="text" value="<?php echo $row['product_type']?>" id="producttype" name="producttype" autocomplete="off" READONLY></td>
   
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

<?php
if($row['product_type'] == "ASB-Senior"||$row['product_type'] == "ASB-Individual" || $row['product_type'] == "ASB-Family"){ 
  echo " ";
}else{?>
<td>No. CB:</td>
<td><input type="number" value ="<?php echo $row['number_cb']?>" id="nocb" name="nocb" autocomplete="off">
<p style="color:red;"><?php if (isset($errors['cb'])) echo $errors['cb']; ?></p></td>


<td> Membership Status:</td>
<td><input type ="text"  value="CBLIC" name="memstatus" autocomplete="off" READONLY>



<?php }?>





<td>Loan Status:</td>
<td> <select id="id" name="loanstatus">
<option value="<?php echo $row['loan_status']?>"><?php echo $row['loan_status']?></option>
        <option value="Active">Active</option>
        <option value="Savers">Savers</option>
        <option value="PAR">PAR</option>
        <option value="Offset">Offset</option>
       
      </select>
</td>
</tr>

<tr>
<td>Date Insured:</td>
<td><input type ="date" value="<?php echo $addinsured;?>" name="dateinsured" class="form-control" READONLY>
<p style="color:red;"><?php if (isset($errors['di'])) echo $errors['di'];?></p></td>

<td>Renewal Date:</td>
<td><input type="date" value="<?php echo $addrenewal;?>" name="renewaldate" class="form-control" READONLY>
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

</td>
</tr>


<tr>
  <td>Coverage of Confirmation:</td>
  <td><input type ="text" value="<?php echo$row['coc']?>" id="coc" name="coc" autocomplete="off">
  <p style="color:red;"><?php if(isset($errors['c'])) echo $errors['c']; ?></p></td>

  <td>Length of Membership:</td>
  <td><input type ="text" value="<?php if ($row['dayoflength'] == "Years"){ echo$row['length'];} else { echo "0";}?>" id="length" name="length" autocomplete="off" READONLY>
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
<?php if($row['product_type'] == "CBK-Member"|| $row['product_type'] == "CBK-Pension" || $row['product_type'] == "ASB-Family"){?>
  <h2>INSURED DEPENDENTS OF MARRIED PRINCIPAL INSURED, IF APPLICABLE </h2>

  <tr>
<td>Spouse FirstName: </td>
<td><input type="text" value="<?php echo $row4['m_firstname']?>" id="mfirstname" name="mfirstname" autocomplete="off" ></td>
<td>Spouse MiddleName:</td>
<td><input type="text" value="<?php echo $row4['m_middlename']?>" id="mmiddlename" name="mmiddlename" autocomplete="off"></td>
<td>Spouse LastName:</td>
<td><input type="text" value="<?php echo $row4['m_lastname']?>" id="mlastname" name="mlastname" autocomplete="off"></td>
<td>Spouse Birthdate:</td>
<td><input type="date" value="<?php echo $row4['m_birthday']?>" name="mbirthdate" class="form-control"></td>
</tr>

<tr>
<td>Child1 Firstname:</td>
<td><input type="text" value="<?php echo $row4['c1_firstname']?>" id="c1firstname" name="c1firstname" autocomplete="off" ></td>
<td>Child1 Middlename:</td>
<td><input type="text" value="<?php echo $row4['c1_middlename']?>"id="c1middlename" name="c1middlename" autocomplete="off"></td>
<td>Child1 Lastname:</td>
<td><input type="text" value="<?php echo $row4['c1_lastname']?>" id="c1lastname" name="c1lastname" autocomplete="off"></td>
<td>Child1 Birthdate:</td>
<td><input type="date" value="<?php echo $row4['c1_birthday']?>" name="c1birthdate" class="form-control"></td>
</tr>

<tr>
  <td>Child2 Firstname:</td>
  <td><input type="text" value="<?php echo $row4['c2_firstname']?>" id="c2firstname" name="c2firstname" autocomplete="off"></td>
  <td>Child2 Middlename:</td>
  <td><input type="text" value="<?php echo $row4['c2_middlename']?>" id="c2middlename" name="c2middlename" autocomplete="off"></td>
  <td>Child2 Lastname:</td>
  <td><input type="text" value="<?php echo $row4['c2_lastname']?>" id="c2lastname" name="c2lastname" autocomplete="off"></td>
  <td>Child2 Birthdate</td>
  <td><input type="date" value="<?php echo $row4['c2_birthday']?>"name="c2birthdate" class="form-control"></td>
</tr>

<tr>
<td>Child3 Firstname:</td>
<td><input type="text" value="<?php echo $row4['c3_firstname']?>"  id="c3firstname" name="c3firstname" autocomplete="off"></td>
<td>Child3 Middlename:</td>
<td><input type ="text" value="<?php echo $row4['c3_middlename']?>" id="c3middlename" name="c3middlename" autocomplete="off"></td>
<td>Child3 Lastname:</td>
<td><input type="text" value="<?php echo $row4['c3_lastname']?>"id="c3lastname" name="c3lastname" autocomplete="off"></td>
<td>Child3 Birthdate:</td>
<td><input type="date" value="<?php echo $row4['c3_birthday']?>" name="c3birthdate" class="form-control"></td>
</tr>

</table>

<table>
<h2>INSURED DEPENDENTS OF SINGLE PRINCIPAL INSURED, IF APPLICABLE</h2>

<tr>
  <td>Adult1 Firstname:</td>
  <td><input type="text" value="<?php echo $row4['a1_firstname']?>" id="a1firstname" name="a1firstname" autocomplete="off"></td>
  <td>Adult1 Middlename:</td>
  <td><input type="text" value="<?php echo $row4['a1_middlename']?>"id="a1middlename" name="a1middlename" autocomplete="off"></td>
  <td>Adult1 Lastname</td>
  <td><input type="text" value="<?php echo $row4['a1_lastname']?>" id="a1lastname" name="a1lastname" autocomplete="off"></td>
</tr>
<tr>
  <td>Adult1 Relationship:</td>
  <td><input type="text" value="<?php echo $row4['a1_relationship']?>" id="a1relationship" name="a1relationship" autocomplete="off"></td>
  <td>Adult1 Birthdate:</td>
  <td><input type="date" value="<?php echo $row4['a1_birthday']?>" name="a1birthdate" class="form-control"></td>
  <td></td>
  <td></td>
</tr>

<tr>
  <td>Adult2 Firstname:</td>
  <td><input type="text" value="<?php echo $row4['a2_firstname']?>" id="a2firstname" name="a2firstname" autocomplete="off"></td>
  <td>Adult2 Middlename:</td>
  <td><input type="text" value="<?php echo $row4['a2_middlename']?>" id="a2middlename" name="a2middlename" autocomplete="off"></td>
  <td>Adult2 Lastname:</td>
  <td><input type="text" value="<?php echo $row4['a2_lastname']?>" id="a2lastname" name="a2lastname" autocomplete="off"></td>
</tr>
<tr>
  <td>Adult2 Relationship:</td>
  <td><input type="text" value="<?php echo $row4['a2_relationship']?>" id="a2relationship" name="a2relationship" autocomplete="off"></td>
  <td>Adult2 Birthdate:</td>
  <td><input type="date"value="<?php echo $row4['a2_birthday']?>" name="a2birthdate" class="form-control"></td>
  <td></td>
  <td></td>
</tr>

<tr>
  <td>Child1 Firstname:</td>
  <td><input type="text" value="<?php echo $row4['a3_firstname']?>" id="a3firstname" name="a3firstname" autocomplete="off"></td>
  <td>Child1 Middlename:</td>
  <td><input type="text" value="<?php echo $row4['a3_middlename']?>" id="a3middlename" name="a3middlename" autocomplete="off"></td>
  <td>Child1 Lastname:</td>
  <td><input type="text"value="<?php echo $row4['a3_lastname']?>" id="a3lastname" name="a3lastname" autocomplete="off"></td>
</tr>
<tr>
  <td>Child1 Relationship:</td>
  <td><input type="text" value="<?php echo $row4['a3_relationship']?>" id="a3relationship" name="a3relationship" autocomplete="off"></td>
  <td>Child1 Birthdate:</td>
  <td><input type="date" value="<?php echo $row4['a3_birthday']?>" name="a3birthdate" class="form-control"></td>
  <td></td>
  <td></td>
</tr>

<tr>
  <td>Child2 Firstname:</td>
  <td><input type="text" value="<?php echo $row4['a4_firstname']?>" id="a4firstname" name="a4firstname" autocomplete="off"></td>
  <td>Child2 Middlename:</td>
  <td><input type="text" value="<?php echo $row4['a4_middlename']?>" id="a4middlename" name="a4middlename" autocompplete="off"></td>
  <td>child2 Lastname:</td>
  <td><input type="text" value="<?php echo $row4['a4_lastname']?>" id="a4lastname" name="a4lastname" autocomplete="off"></td>
</tr>

<tr>
  <td>Child2 Relationship:</td>
  <td><input type="text" value="<?php echo $row4['a4_relationship']?>" id="a4relationship" name="a4relationship" autocomplete="off"></td>
  <td>Child2 Birthdate:</td>
  <td><input type="date" value="<?php echo $row4['a4_birthday']?>" name="a4birthdate" class="form-control"></td>
  <td></td>
  <td></td>
</tr>

  


<?php }?>

</table>


<br>


<h1><input onclick="checker()" type="submit" name="submit" value="Submit"></h1>



<script>
function checker(){

  var result = confirm('ARE YOU SURE YOU WANT TO RENEW THIS ACCOUNT ?');

  if(result == false){

    event.preventDefault();
  }
}
  </script>


</body>
</html>




