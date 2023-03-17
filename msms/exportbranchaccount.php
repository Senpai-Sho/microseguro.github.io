<?php 

if(!isset($_SESSION)){

    session_start();

}
if(!isset($_SESSION['Access']){

  header("Location: login.php");
})


include_once("connections/connection.php");
$con= connection();




if (isset($_POST['submit'])){

    $sql = "SELECT * FROM kps_branches ORDER BY branch_account";
    $cbform = $con->query($sql) or die(con->connect_error);
    $row = $cbform->fetch_assoc();
    ?>






   <div class="table-responsive">
   <BR>
      <table class="table custom-table">
        <thead>
          <tr>
          <th scope="col">Account</th>
            <th scope="col">Branch Name</th>
      
       
          </tr>
        </thead>
        <tbody>
          <?php  do{?>
          <tr scope="row"> 
            <td><?php echo$row['branch_account']?></td>
            <td><?php echo$row['branch_name']?></td>
      
          
          </tr>

          <?php }while($row = $cbform->fetch_assoc())?> 


        </tbody>
      </table>
    </div>
  <?php

   
              
                header('Content-Type: application/xls');
                header('Content-Disposition:attachment;filename=branchaccount.xls');
                
}

?>