<?php 

if(!isset($_SESSION)){

    session_start();

}

if(!isset($_SESSION['Access'])){

  header("Location: login.php");
}



include_once("connections/connection.php");
$con= connection();

$sql = "SELECT * FROM kps_branches ORDER BY branch_account";
$kpsbranch = $con->query($sql) or die ($con->connect_error);
$row = $kpsbranch->fetch_assoc();


?>




<!DOCTYPE html>
<html>


<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--for icon -->
<!--for icon -->
    
<title> MICRO SEGURO MANAGEMENT </title>


<style>
body {
  margin: 0;
}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  width: 25%;
  background-color: #f1f1f1;
  position: fixed;
  height: 100%;
  overflow: auto;
}

li a {
  display: block;
  color: #000;
  padding: 8px 16px;
  text-decoration: none;
}

li a.active {
  background-color: #04AA6D;
  color: white;
}

li a:hover:not(.active) {
  background-color: #90ee90;
  color: white;
}
</style>
</head>
<body>

<ul>

<li><a href="memberindex.php"><i class="fa fa-caret-square-o-left" style="font-size:24px;color:green"></a></i></li>


<?php do{?>
<li><a href="memberbranch.php?BRANCH=<?php echo$row['branch_name'];?>"><?php echo $row['branch_name'];?></a></li>

<?php } while($row = $kpsbranch->fetch_assoc())?>
</ul>

<div style="margin-left:25%;padding:1px 16px;height:1000px;">
  <!-- type here -->
</body>
</html>



