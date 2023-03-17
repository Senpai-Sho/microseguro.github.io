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

$sql = "SELECT * FROM system_user ORDER BY id ";
$systemuser = $con->query($sql) or die(con->connect_error);
$row = $systemuser->fetch_assoc();

$sql ="SELECT * FROM system_user WHERE access = '$useraccess'";
$system = $con->query($sql) or die ($con->connect_error);
$row1 = $system->fetch_assoc();


?>




<!doctype html>
<html lang="en">
  <head>
    <!--for icon -->
  <meta name='viewport' content='width=device-width, initial-scale=1'>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--for icon -->



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

  <head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">


</head>

<?php // ------------------------------- ?>

<head>
<style>

button{
  border:none;
  background-color:white;
}

body {
  background-color:white;
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
  <li><a href="system.php"><i class="fa fa-caret-square-o-left" style="font-size:24px;color:green"></a></i></li>


</ul>


  <div class="content">
    
    <div class="container">
      <br>
      <br>
      <h2 class="mb-5">System User </h2>


  <?php if($_SESSION['Access'] == "MS Master" || $_SESSION['Access'] == "Developer"){?>
      <td><a href="adduser.php?UserAccess=<?php echo $_SESSION['Access'];?>"><i class="fa fa-file-text-o" style="font-size:30px;color:green"></i></a>  &nbsp;  &nbsp;</td>
      <?php } ?>   



      <div class="table-responsive">
     
        <table class="table custom-table">
          <thead>
            <tr>
              
    

              <th scope="col">ID</th>
              <th scope="col">User Name</th>
              <th scope="col">Password</th>
              <th scope="col">Access</th>
              



              
      
            </tr>
          </thead>
          <tbody>

               
          <?php if($_SESSION['Access'] == "MS Master" || $_SESSION['Access'] == "Developer"){?>
            
              <?php echo "";?>
                <?php }else{?>

                    <td><?php echo$row1['id']?></td>
              <td><?php echo$row1['user_name']?></td>
              <td><?php echo$row1['pass_word']?></td>
              <td><?php echo$row1['access']?></td>
              <td><a href="updateuser.php?UserAccess=<?php echo $row1['id'];?>"><i class="fa fa-toggle-up" style="font-size:25px;color:green"></i></a></td>
                <?php }?>


            <?php  do{?>
            <tr scope="row"> 

            
          <?php if($_SESSION['Access'] == "MS Master" ){?>

            
          
              <td><?php if($row['id'] == "1"){ echo "";} else {echo $row['id'];}?></td>
              <td><?php if($row['user_name'] == "DEVELOPER"){ echo "";} else {echo $row['user_name'];}?></td>
              <td><?php if($row['pass_word'] == "noonecanenter"){ echo "";} else {echo $row['pass_word'];}?></td>
              <td><?php if($row['access'] == "Developer"){ echo "";} else {echo $row['access'];}?></td>

              <td><a href="updateuser.php?UserAccess=<?php if($row['id'] == "1"){ echo "";} else {echo $row['id'];}?>"><?php if($row['id'] == "1"){ echo "";} else {echo '<i class="fa fa-caret-square-o-right"style="font-size:24px;color:green"></i></td>';}?>
            
              <form action="deleteuser.php" method="post">
            
                
                <?php 

                if($row['access'] == "Developer" || $row['access'] == "MS Supervisor" || $row['access'] == "MS Processor" || $row['access'] == "MS Master"){
                echo ""; 
                 } else {?>

                <td><button onclick="master()" type="submit" name="delete"> <i class="fa fa-trash" style="font-size:25px;color:red"></i></button></td>
                <td><input type="hidden" name="userid" value = "<?php echo $row['id'];?>"> 
                </form>

                <?php } ?>


                 
                

                
                
            <!--    
               
              
                 -->

                <?php }?>



              

                <?php if($_SESSION['Access'] == "Developer"){?>
            
               

                 <td><?php echo$row['id']?></td>
                 <td><?php echo$row['user_name']?></td>
                 <td><?php if($row['pass_word'] == "noonecanenter"){ echo "<input type='password' value ='$row[pass_word]' id='myInput' ><br><input type='checkbox' onclick='myFunction()'>";} else {echo $row['pass_word'];}?></td>
                 <td><?php echo$row['access']?></td>
                 <td><a href="updateuser.php?UserAccess=<?php echo $row['id'];?>"><i class="fa fa-toggle-up" style="font-size:25px;color:green"></i></a></td>
          


            <form action="deleteuser.php" method="post"> 
            <?php 

            if($row['access'] == "Developer"){
            echo ""; 
             } else {?>

            <td><button onclick="developer()" type="submit" name="delete"> <i class="fa fa-trash" style="font-size:25px;color:red"></i></button></td>
            <td><input  type="hidden" name="userid" value = "<?php echo $row['id'];?>"> 
            </form>
<?php } ?>

                 
             
                 <?php }?>
 
         
            
            </tr>


                        <script>
                        function myFunction() {
                          var x = document.getElementById("myInput");
                          if (x.type === "password") {
                            x.type = "text";
                          } else {
                            x.type = "password";
                          }
                        }
                        </script>

            <?php }while($row = $systemuser->fetch_assoc())?> 

            
          </tbody>
        </table>
      </div>


    </div>

  </div>
    
    

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

<script>

function developer(){ 

var result = confirm('ARE YOU SURE YOU WANT TO DELETE THIS USER ?');
if(result == false){

  event.preventDefault();
}
}

function master(){ 

var result = confirm('ARE YOU SURE YOU WANT TO DELETE THIS USER ?');
if(result == false){

  event.preventDefault();
}
}

</script>
    
  </body>
</html>