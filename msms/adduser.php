<?php 
if(!isset($_SESSION)){

    session_start();
}

if(!isset($_SESSION['Access'])){
  header("Location: login.php");
}


include_once("connections/connection.php");
$con = connection();

$useraccess = $_GET["UserAccess"];

if(isset($_POST['submit'])){
  

    $username = $_POST['username'];
    $password = $_POST['password'];
    $useraccesscode = $_POST['useraccesscode'];
    $userstatus = $_POST['userstatus'];




    $errors = array();

    $acc = "SELECT user_name FROM system_user WHERE user_name = '$username'";
    $acct = mysqli_query($con,$acc);

  
    if(empty($username)){
        $errors['pi'] = "username Required";
    }else if (mysqli_num_rows($acct)>0){
        $errors['pi'] = "Username Exist";
    }

    if(empty($password)){
        $errors['pm'] = "Password Required";
    }

    if(empty($useraccesscode)){
        $errors['c'] = "Access Required";
    }

    if (count($errors) == 0){

        $sql1 = "INSERT INTO `system_user`(`user_name`,`pass_word`,`access`,`user_status`)
        VALUES('$username','$password','$useraccesscode','$userstatus')";
        $con->query($sql1) or die ($con->error);

        if ($con){
            echo "<script>alert('done')</script>";
        }else{ 
          echo "<script>alert('Failed')</script>";
        }
      
        echo header("location: usercode.php?UserAccess=".$useraccess); 
      
    }

    }






?>



<!DOCTYPE html>
<html>
<head>
<title>MICRO SEGURO MANAGEMENT </title>


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
<li><button onclick="history.back()"><i class="fa fa-caret-square-o-left" style="font-size:24px;color:green"></a></i></li>


</ul>

<div class="content">
<div class="container">


  <form action="" method="post">

  <input type="hidden" id="userstatus" name="userstatus" value="Active">
  <div class="row">
    <div class="col-25">

    
   
      <label>Username</label>
      
    </div>
    <div class="col-75">
    <input type="text" id="username" name="username" autocomplete="off" >
      <p style="color:red;"><?php if (isset($errors['pi'])) echo $errors['pi']; ?></p>
    </div>
    
  </div>
  <div class="row">
    <div class="col-25">
      <label>Password</label>
    </div>
    <div class="col-75">
      <input type="text" id="password" name="password" autocomplete="off" >
      <p style="color:red;"><?php if (isset($errors['pm'])) echo $errors['pm']; ?></p>
    </div>
  </div>

  <div class="row">
    <div class="col-25">
      <label>Access</label>
    </div>
    <div class="col-75">

    <?php if($_SESSION['Access'] == "Developer"){?>
        
        <select id="id" name="useraccesscode">
        <option value="Guest">Guest</option>
        <option value="MS Processor">MS Processor</option>
        <option value="MS Supervisor">MS Supervisor</option>
        <option value="MS Master">MS Master</option>
     


      </select>
      <p style="color:red;"><?php if (isset($errors['c'])) echo $errors['c']; ?></p>

      <?php } else {?>
    <input type="text" id="useraccesscode" value="Guest" name="useraccesscode" READONLY autocomplete="off">
           <p style="color:red;"><?php if (isset($errors['pi'])) echo $errors['pi']; ?></p>
           <?php } ?>


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

var result = confirm('DO YOU WANT TO ADD THIS USER ?');

if(result == false) {

  event.preventDefault();
}
}


</script>  
</body>
</html>
