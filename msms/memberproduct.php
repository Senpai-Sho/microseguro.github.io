<?php 
if(!isset($_SESSION)){
session_start();
}

if(!isset($_SESSION['Access'])){
  header("Location: login.php");
}


include_once("connections/connection.php");
$con = connection();

$accountnumber = $_GET["AccountNumber"];



$sql = "SELECT * FROM  member_info WHERE account_number = '$accountnumber'";
$memberinfo = $con->query($sql) or die ($con->connect_error);
$row = $memberinfo ->fetch_assoc();

$sql = "SELECT * FROM  cb_kalinga WHERE account_number = '$accountnumber'";
$cblic = $con->query($sql) or die ($con->connect_error);
$row1 = $cblic ->fetch_assoc();


?> 

<!DOCTYPE html>
<html>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

<link rel="stylesheet" type="text/css" href="printinfo.css" media="print">

    <!-- Required meta tags -->
<head>
<style>


 .print{
border:none;
background-color: #38444d;
cursor:pointer;
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
<title> MICRO SEGURO MANAGEMENT </title>


<ul>
<li><a href = "memberinfo.php"><i class="fa fa-caret-square-o-left" style="font-size:24px;color:green"></a></i></li>


  <li style="float:right"><a><?php echo"Status: ".$row['Status'],' '?>
<?php if($row['Status'] == "Active"){?>
  <i class="fa fa-check-circle-o" style="font-size:24px;color:green"></i>
<?php } else if($row['Status']=="Closed"){?>
  <i class="fa fa-times-circle-o" style="font-size:24px;color:red"></i>
  <?php }else if($row['Status'] == 'Renewed'){?>
    <i class="fa fa-user-plus" style="font-size:20px;color:green"></i></i>
  <?php }else {
    echo"";
  }?>




  <li style="float:right"><button onclick="window.print()" class="print" id="print-btn"> <i class="fa fa-print" style="font-size:23px;color:green"></i> <b> PRINT </b> </button></li>
  
</a></li>             
    


</ul>

</body>
</html>










  



  <!DOCTYPE html>
<html>
<head>




<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif}
</style>
</head>
<style>

h3{
  text-align:center;
}
H5{
  text-align:center;
}
p{
text-align:center;

}
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}


td, th {
  border: 3px solid #dddddd;
  text-align: left;
 /* padding: 8px;*/
}

tr:nth-child(even) {
  background-color: #dddddd;
}


</style>
</head>

<table class="report-container">

<tr>
<thead class="report-header">
  <th>
<h5>KPS-SEED MICROFINANCE INC.</H5>
<H3>MICRO SEGURO CLIENT INFORMATION </H3>
</th>
</tr>
</table>



<table>
         
        <tr>
        <td> <?php echo "Account Name"?> 
          <?php if($row['Status'] == "Renewed" || $row['Status'] == "Closed"){
              echo "";
          }else {?>

          <?php if($_SESSION['Access'] == "MS Supervisor"|| $_SESSION['Access'] == "Developer"){?>
             <a href="updateaccountinfo.php?AccountNumber=<?php echo $row['account_number'];?>"><i class="fa fa-toggle-up" style="font-size:25px;color:green"></i></a>
      
                <?php }?>

                <?php }?>

              <?php echo"<b><br>",$row['full_name'],  '</b>'?>    </td>
       
   
        

        
          <td><?php echo"Account Number<br><b>",$row['account_number']?></td>

          <td><?php echo"No. CB <br><b>",$row['number_cb']?></td>

          <td><?php echo"Branch<br><b>",$row['branch_name']?></td>
          </tr>
          <tr>
          <td><?php echo"Product Type <br><b>",$row['product_type']?></td>

          <td><?php echo"Loan Product<br><b>",$row['loan_product']?></td>

          
         <td> <?php echo"Confirmation of Coverage <br><b>",$row['coc']?></td>

         
          <td><?php echo"Unit <br><b>",$row['unit']?></td>
          </tr>
          <tr>
          
         <td> <?php echo"Gender",'<br><b>',$row['gender']?></td>

          
          <td><?php echo"Birth Date <br><b>",$row['birth_date']?></td>

         
         <td> <?php echo"Civil Status<br><b>",$row['civil_status']?></td>
          
        
          <td><?php echo"Length of Insured<br><b>",$row['length'].' '.$row['dayoflength']?></td>
          </tr>
          <tr>

          <td><?php echo"Date of Membership <br><b>",$row['date_member']?></td>
         
         <td> <?php echo"Date of Insured<br><b>",$row['date_insured']?></td>

          
         
          <td><?php echo"Renewal Date<br><b>",$row['renewal']?></td>

           
        
          <td><?php echo"Address<br><b>",$row['address']?></td>

          </tr>
          <tr>

          <td> <?php echo"Membership Status <br> <b>",$row['membership_status']?></td>
          <td> <?php echo "Loan Status<br><b>",$row['loan_status']?></td>
          </tr>
       
          
          

       

         
          </table>
        
      <br>
       <table>
       <h2>BENEFICIARY </h2>
        

<tr>
 
          <td><?php echo"<b>Name</b> <br>",$row1['b_firstname'],' ',$row1['b_middlename'],' ',$row1['b_lastname']?></td>
          <td><?php echo"<b>Birthday </b><br>", $row1['b_birthday']?></td>
    <td> <?php echo "<b>Relationship </b><br>",$row1['b_relationship']?></td>
          
          </tr>
        </table>


<br><br>
       <table>
        <h2 ></i>INSURED DEPENDENTS OF MARRIED PRINCIPAL INSURED. IF APPLICABLE</h2>
       
    
    
  <tr>
    <td> </td>
    <th><p style="color:green;">Name</p></th>
    
  
    <th><p style="color:green;">Date of Birth</p></th>
 
  </tr>
  <tr>
    <td>Spouse</td>
    <td><?php echo"<b>",$row1['m_firstname'],' ',$row1['m_middlename'],' ',$row1['m_lastname'],'</b>'?></td>
    <td><?php echo"<b>",$row1['m_birthday']?></td>
  </tr>
  <tr>
  <td>Child 1</td>
  <td><?php echo"<b>",$row1['c1_firstname'],' ',$row1['c1_middlename'],' ',$row1['c1_lastname'],'</b>'?></td>
  <td><?php echo"<b>",$row1['c1_birthday']?></td>
  </tr>
  <tr>
  <td>Child 2</td>
  <td><?php echo"<b>",$row1['c2_firstname'],' ',$row1['c2_middlename'],' ',$row1['c2_lastname'],'</b>'?></td>
  <td><?php echo"<b>",$row1['c2_birthday']?></td>
  </tr>
  <tr>
  <td>Child 3</td>
  <td><?php echo"<b>",$row1['c3_firstname'],' ',$row1['c3_middlename'],' ',$row1['c3_lastname'],'</b>'?></td>
  <td><?php echo"<b>",$row1['c3_birthday']?></td>
  </tr>

          </table> 
          <br>
 <table>

      <h2></i>INSURED DEPENDENTS OF SINGLE PRINCIPAL INSURED. IF APPLICABLE</h2>
     
  
  <tr>
    <td> </td>
    <th><p style="color:green;">Name</p></th>
    <th><p style="color:green;">Relationship</p></th>
    <th><p style="color:green;">Date of Birth</p></th>
   

  </tr>
  <tr>
    <td>Adult/Parent 1</td>
    <td><?php echo"<b>",$row1['a1_firstname'],' ',$row1['a1_middlename'],' ',$row1['a1_lastname'],'</b>'?></td>
    <td><?php echo"<b>",$row1['a1_relationship']?></td>
    <td><?php echo"<b>",$row1['a1_birthday']?></td>
  <tr>
  <td>Adult/Parent 2</td>
  <td><?php echo"<b>",$row1['a2_firstname'],' ',$row1['a2_middlename'],' ',$row1['a2_lastname'],'</b>'?></td>
    <td><?php echo"<b>",$row1['a2_relationship']?></td>
    <td><?php echo"<b>",$row1['a2_birthday']?></td>
  
  </tr>
  <tr>
  <td>Child 1</td>
  <td><?php echo"<b>",$row1['a3_firstname'],' ',$row1['a3_middlename'],' ',$row1['a3_lastname'],'</b>'?></td>
    <td><?php echo"<b>",$row1['a3_relationship']?></td>
    <td><?php echo"<b>",$row1['a3_birthday']?></td>
  
  </tr>
  <tr>
  <td>Child 2</td>
  <td><?php echo"<b>",$row1['a4_firstname'],' ',$row1['a4_middlename'],' ',$row1['a4_lastname'],'</b>'?></td>
    <td><?php echo"<b>",$row1['a4_relationship']?></td>
    <td><?php echo"<b>",$row1['a4_birthday']?></td>
 
  </tr>

  </table>


</div>
        <hr>
      </div>
      
     



</body>
</html>



  
  

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
</body>
</html>