<?php 


if(!isset($_SESSION)){

  session_start();

}

if(!isset($_SESSION)){
  header("Location: login.php");
}



include_once("connections/connection.php");
$con = connection();

if(isset($_POST['submit'])){

  $account = $_POST['accountnumber'];
  $fname = $_POST['firstname'];
  $lname = $_POST['lastname'];
  $mname = $_POST['middlename'];
  $minitial = $_POST['middleinitial'];
  $gender = $_POST['gender'];
  $cstatus = $_POST['civilstatus'];
  $bdate = $_POST['bdate'];
  $address = $_POST['Address'];
  $datemember = $_POST['memberdate'];

  $errors = array();

  $acc = "SELECT account_number FROM member_account WHERE account_number = '$account'";
  $acct = mysqli_query($con,$acc); //exist codes
  

if (empty($account)){
  $errors['acc'] = "Account Number Required";
  }else if (mysqli_num_rows($acct)>0){
    $errors['acc'] = "Account Number Exist";
  }
  
  

if (empty($fname)){
  $errors['f'] = "First Name Required";
  }
  
if (empty($lname)){
$errors['l'] = "Last Name Required";

}

if(empty($mname)){
$errors['m'] = "Middle Name Required";
}

if(empty($minitial)){
  $errors['mi'] = "Middle Initial Required";
}

if(empty($bdate)){
  $errors['bd'] = "Birth Date Required";
}

if(empty($datemember)){
  $errors['md'] = "Date Of Membership";

}

if(empty($address)){
  $errors['add'] = "Address Required";
}

if (count($errors)==0){

  // ^^ duplicate & blank info


  $sql = "INSERT INTO `member_account`( `account_number`,`first_name`, `last_name`,`middle_name`,
  `middle_initial`,`gender`,`civil_status`,`birth_date`,`member_address`,`date_member`) VALUES ('$account','$fname', '$lname', '$mname',
  '$minitial','$gender','$cstatus','$bdate','$address','$datemember')"; 
  $con->query($sql) or die ($con->error);

  
  if ($con){
    echo "<script>alert('done')</script>";
  }else{ 
    echo "<script>alert('Failed')</script>";
  }

  echo header("location: memberaccount.php"); 

}
}


?>








<!DOCTYPE html>
<html>
<head>
<title>MICRO SEGURO MANAGEMENT</title>


      <!--for icon -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  background: #555;
}

.content {
  max-width: 500px;
  margin: auto;
  background: white;
  padding: 10px;
}

* {
  box-sizing: border-box;
}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit] {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
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
  <li><a href="memberaccount.php"><i class="fa fa-caret-square-o-left" style="font-size:24px;color:green"></a></i></li>


</ul>

<div class="content">
<div class="container">


<script src="js/sweetalert.min.js"></script>




<form action="" method="post">
  
  <div class="row">
    <div class="col-25">

  
   
      <label>Account Number</label>
      
    </div>
    <div class="col-75">
      <input type="text" id="accountnumber" name="accountnumber" autocomplete="off">
      <p style="color:red;"><?php if (isset($errors['acc'])) echo $errors['acc']; ?></p>
    </div>
    
  </div>
  <div class="row">
    <div class="col-25">
      <label>First Name</label>
    </div>
    <div class="col-75">
      <input type="text" id="firstname" name="firstname" autocomplete="off" >
      <p style="color:red;"><?php if (isset($errors['f'])) echo $errors['f']; ?></p>
    </div>
  </div>

  <div class="row">
    <div class="col-25">
      <label>Middle Name</label>
    </div>
    <div class="col-75">
      <input type="text" id="middlename" name="middlename" autocomplete="off">
      <p style="color:red;"><?php if (isset($errors['m'])) echo $errors['m']; ?></p>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label>Last Name</label>
    </div>
    <div class="col-75">
      <input type="text" id="lastname" name="lastname" autocomplete="off">
      <p style="color:red;"><?php if (isset($errors['l'])) echo $errors['l']; ?></p>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label>Middle Initial</label>
    </div>
    <div class="col-75">
      <input type="text" id="middleinitial" name="middleinitial" autocomplete="off">
      <p style="color:red;"><?php if (isset($errors['mi'])) echo $errors['mi']; ?></p>
    </div>
  </div>

  <div class="row">
    <div class="col-25">
      <label>Address</label>
    </div>
    <div class="col-75">
      <input type="text" id="Address" name="Address" autocomplete="off">
      <p style="color:red;"><?php if (isset($errors['add'])) echo $errors['add']; ?></p>
    </div>
  </div>

  <div class="row">
    <div class="col-25">
      <label>Gender</label>
    </div>
    <div class="col-75">
      <select id="id" name="gender">
        <option value="Female">Female</option>
        <option value="Male">Male</option>
      </select>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label>Civil Status</label>
    </div>
    <div class="col-75">
      <select id="id" name="civilstatus">
        <option value="Single">Single</option>
        <option value="Married">Married</option>
        <option value="Common Law">Common Law</option>
        <option value="Widowed">Widowed</option>
        <option value="Separated">Separated</option>
       
      </select>
    </div>
  </div>

  <div class="row">
    <div class="col-25">
      <label>Date of Membership</label>
    </div>
    <div class="col-75">
      <br>
    <input type="date" name="memberdate" class="form-control">
    <p style="color:red;"><?php if (isset($errors['md'])) echo $errors['md']; ?></p>

    </div>
  </div>

  <div class="row">
    <div class="col-25">
      <label>Birth Date</label>
    </div>
    <div class="col-75">
      <br>
    <input type="date" name="bdate" class="form-control">
    <p style="color:red;"><?php if (isset($errors['bd'])) echo $errors['bd']; ?></p>

    </div>
  </div>

  <br>
  <div class="row">
    <input onclick="checker()" type="submit" name="submit" value="Submit">
  </div>
  </form>



</div>


</div>


<script>
      
      
      function checker(){

       
        var result = confirm('DO YOU WANT TO SAVE THIS ACCOUNT ?');
       
     
        if(result == false){
          event.preventDefault();
      

        }

      }
   
</script>

</body>
</html>
