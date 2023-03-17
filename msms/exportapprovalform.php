<?php
if(!isset($_SESSION)){
  session_start();
}

if(!isset($_SESSION['Access'])){

  header("Location: login.php");
}

include_once("connections/connection.php");
$con = connection();


if (isset($_POST['submit'])){

$sql = "SELECT * FROM formnumber_data ORDER BY form_number";
$approvalform = $con->query($sql) or die(con->connect_error);
$row = $approvalform->fetch_assoc();

?>

<div class="table-responsive">
     
        <table class="table custom-table">
          <thead>
            <tr>
            <th scope="col">Approval Date</th>
              <th scope="col">Form Number</th>
              <th scope="col">Account Number</th>
              <th scope="col">Member Name </th>
              <th scope="col">Type of Claims </th>
              <th scope="col">Patient  Name </th>
         
            </tr>
          </thead>
          <tbody>
            <?php  do{?>
            <tr scope="row"> 
              <td><?php echo$row['approval_date']?></td>
              <td><?php echo$row['form_number']?></td>
              <td><?php echo$row['account_number']?></td>
              <td><?php echo$row['full_name']?></td>
              <td><?php echo$row['claims_type']?></td>
              <td><?php echo$row['patient_name']?></td>
                
            
               
            
            </tr>

            <?php }while($row = $approvalform->fetch_assoc())?> 
          </tbody>
        </table>
      </div>

<?php
header('Content-Type: application/xls');
header('Content-Disposition:attachment;filename=approvalform.xls');




}
?>