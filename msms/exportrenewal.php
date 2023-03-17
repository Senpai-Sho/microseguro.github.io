<?php


if(!isset($_SESSION)){

    session_start();

}

if(!isset($_SESSION['Access'])){
  header("Location: login.php");
}


include_once("connections/connection.php");
$con= connection();




$from_date = $_POST['from'];
$to_date = $_POST['to'];
$branchname = $_POST['branch'];
?>

<table>
  <tr>
<td>From: <?php echo $from_date;?></td>
<td>To: <?php echo $to_date; ?> </td>
<td>Branch <?php echo $branchname; ?> </td>
</tr>
</table>

<?php

if (isset($_POST['submit'])){

  header('Content-Type: application/xls');
  header('Content-Disposition:attachment;filename=BORDEREAUX.xls');
  

?>

<br>
<br>


<table class="table custom-table">
<thead>


  <tr>
    
    <th scope="col">Account Number</th>
    <th scope="col">CB #</th>
    <th scope="col">Full Name</th>
    <th scope="col">Birthdate</th>
    <th scope="col">Loan Status</th>
    <th scope="col">Date of Latest Loan</th>
    <th scope="col">Loan Amount</th>
    <th scope="col">Length of Membership</th>
    <th scope="col">Gender</th>
    <th scope="col">Civil Status</th>
    <th scope="col">Residential Address</th>
    <th scope="col">No. of Units</th>
    <th scope="col">Date of Membership / Loan Release</th>
    <th scope="col">Term of Coverage</th>
    
    <th scope="col">Surname</th>
    <th scope="col">First Name</th>
    <th scope="col">Middle Name</th>
    <th scope="col">Birthdate</th>
    <th scope="col">Surname</th>
    <th scope="col">First Name</th>
    <th scope="col">Middle Name</th>
    <th scope="col">Birthdate</th>
    <th scope="col">Surname</th>
    <th scope="col">First Name</th>
    <th scope="col">Middle Name</th>
    <th scope="col">Birthdate</th>
    <th scope="col">Surname</th>
    <th scope="col">First Name</th>
    <th scope="col">Middle Name</th>
    <th scope="col">Birthdate</th> 
    <th scope="col">Full Name</th> 
    <th scope="col">Relationship to the principal member</th> 
    <th scope="col">Gross Premium</th> 
    <th scope="col">Net Premium</th> 
    <th scope="col">Remarks</th> 


  
  </tr>
</thead>

<?php



$query = "SELECT * FROM member_info WHERE renewal BETWEEN '$from_date' AND '$to_date' AND branch_name = '$branchname' ORDER BY Status ";
$query_run = mysqli_query($con, $query);


    foreach($query_run as $row){

      $accountnumber = $row['account_number'];
      $sql1 = "SELECT * FROM  cb_kalinga WHERE account_number = '$accountnumber'";
      $cblic = $con->query($sql1) or die ($con->connect_error);
      $row1 = $cblic ->fetch_assoc();

      $sql2 = "SELECT * FROM  cgl_data WHERE account_number = '$accountnumber'";
      $cgldata = $con->query($sql2) or die ($con->connect_error);
      $row2 = $cgldata ->fetch_assoc();
        ?>
  


  
        <tr>
       

         <?php 
         if($row['product_type'] == "CGL-Loan Insurance" ){ ?>
          
          <?php echo "";?>
          
         

        <?php }else{?>
        
          <td><?= $row['account_number'];?></td>
         <td><?= $row['number_cb'];?></td>
         <td><?= $row['full_name'];?></td>
         <td><?= $row['birth_date'];?></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td><?= $row['gender'];?></td>
         <td><?= $row['civil_status'];?></td>
         <td><?= $row['address'];?></td>
         <td><?= $row['unit'];?></td>
         <td><?= $row['date_insured'];?></td>
         <td><?= $row['length'];?></td>
         
      <?php  } ?>

      <?php if($row['civil_status'] == "Single"){?>
            <td><?= $row1['a1_lastname'];?></td>
            <td><?= $row1['a1_firstname'];?></td>
            <td><?= $row1['a1_middlename'];?></td>
            <td><?= $row1['a1_birthday'];?></td>
            <td><?= $row1['a2_lastname'];?></td>
            <td><?= $row1['a2_firstname'];?></td>
            <td><?= $row1['a2_middlename'];?></td>
            <td><?= $row1['a2_birthday'];?></td>
            <td><?= $row1['a3_lastname'];?></td>
            <td><?= $row1['a3_firstname'];?></td>
            <td><?= $row1['a3_middlename'];?></td>
            <td><?= $row1['a3_birthday'];?></td>
            <td><?= $row1['a4_lastname'];?></td>
            <td><?= $row1['a4_firstname'];?></td>
            <td><?= $row1['a4_middlename'];?></td>
            <td><?= $row1['a4_birthday'];?></td>


          <?php }else if($row2 ==""){ 


                echo ""; ?>




          <?php}else{?>
            <td><?= $row1['m_lastname'];?></td>
            <td><?= $row1['m_firstname'];?></td>
            <td><?= $row1['m_middlename'];?></td>
            <td><?= $row1['m_birthday'];?></td>
            <td><?= $row1['c1_lastname'];?></td>
            <td><?= $row1['c1_firstname'];?></td>
            <td><?= $row1['c1_middlename'];?></td>
            <td><?= $row1['c1_birthday'];?></td>
            <td><?= $row1['c2_lastname'];?></td>
            <td><?= $row1['c2_firstname'];?></td>
            <td><?= $row1['c2_middlename'];?></td>
            <td><?= $row1['c2_birthday'];?></td>
            <td><?= $row1['c3_lastname'];?></td>
            <td><?= $row1['c3_firstname'];?></td>
            <td><?= $row1['c3_middlename'];?></td>
            <td><?= $row1['c3_birthday'];?></td>

          <?php } ?>

          <?php if($row2 ==""){ 

                echo " "; ?>
          <?php}else{?>
            <td><?= $row1['b_lastname'].', '.$row1['b_firstname'].' '.$row1['b_middleinitial'];?></td>
            <td><?= $row1['b_relationship'];?></td>
    
          <?php }?>
        
      

    </tr>
 
<?php






        }

      
                  
}


             
?>


