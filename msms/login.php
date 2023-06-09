<?php
if (!isset($_SESSION)){

  session_start();

}
include_once("connections/connection.php");


$con = connection();
$conn = pdo_con();

if(isset($_POST['login'])){

  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = $conn->prepare("SELECT * FROM system_user WHERE user_name = :user AND pass_word = :pass");
  $sql->bindParam(":user",$username);
  $sql->bindParam(":pass",$password);
  $sql->execute();
  $count = $sql->rowCount();

 


if($count>0){
  $row = $sql->fetchAll(PDO::FETCH_ASSOC)[0];
  $_SESSION['UserLogin'] = $row['user_name'];
  $_SESSION['Access'] = $row['access'];
  echo header("location:index.php");

}else{
  $errors['wrong'] = "The Username or Password you entered isn't connected to an account. Please Try Again";

}


}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">

    <title>MICRO SEGURO MANAGEMENT</title>
  </head>
  <body>
  

  
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-4 order-md-2">
            
             
           <img src="img/kps.PNG" alt="Image" class="img-fluid">


        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">


               <h3><strong>Micro Seguro Management System</strong></h3>
              <p class="mb-4">KPS SEED MICROFINANCE INC.</p>
            </div>




            <form action="" method="post">
              <div class="form-group first">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" autocomplete="off">

              </div>
              <div class="form-group last mb-4">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
              
              </div>
              <p style="color:red;"><?php if (isset($errors['wrong'])) echo $errors['wrong']; ?></p>
              
     
              <input type="submit" name="login" value="Log In" class="btn text-white btn-block btn-primary">

        
              
      
            </form>
            </div>
          </div>
          
        </div>
        
      </div>
    </div>
  </div>

  
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>