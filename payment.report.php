<?php  
include 'classes/Init.php';
include 'templates/template_header.php'; 
include 'templates/template_sidebar.php';
$config = array('host' => 'localhost', 'user' => 'mahmudbakale', 'pass' => 'root', 'db' => 'skul');
$db = new Sqli($config);
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Payments</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Payments</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        	<!-- New User form elements -->
        	<div class="card">
        	  <div class="card-header">
                <h1>Payments Report</h1>
        	  </div>
        	  <!-- /.card-header -->
        	  <!-- form start -->
        	    <div class="card-body">
                <form action="" method="POST" class="row">
                <div class="col-lg-3">
                  From
                  <input type="date" name="from" class="form-control">
                </div>
                <div class="col-lg-3">
                  To
                  <input type="date" name="to" class="form-control">
                </div>
                <div class="col-lg-3">
                  Term
                  <select name="term" id="term" class="form-control">
                    <?php
                      for($x=1; $x<=3; $x++) {
                        
                        echo "<option>".$x."</option>";
                      }
                     ?>
                  </select>
                </div>
                <div class="col-lg-3">
                  Session
                 <select name="session" id="session" class="form-control">
                   <?php
                     for($x=2011; $x<=date('Y'); $x++) {
                       echo "<option ";
                       echo ($x == date('Y')) ? " selected " : " ";
                       echo ">". ($x)."/".($x+1)."</option>";
                     }
                   ?>
                 </select>
                </div>
                <div class="col-lg-3">
                  <br>
                  <button type="submit" name="search" class="btn btn-success"><i class="fa fa-search"></i> Search</button>
                </div>
              </form>
              <br><hr>
              <div class="col-lg-12">
                <?php 
                if (isset($_POST['search'])) {
                    $from = $_POST['from'];
                    $to = $_POST['to'];
                    $term = $_POST['term'];
                    $session = $_POST['session'];
                    $rows = $db->Rows("SELECT * FROM `student_payment` INNER JOIN verified_payment USING(payment_id) INNER JOIN section USING(section_id) INNER JOIN users USING(user_id) WHERE term = '$term' AND session ='$session' AND payment_date BETWEEN '$from' AND '$to'");

                    //print_r($rows);
                }
                

                 ?>
                 <table class="table table-striped" id="fullpayment">
                   <thead>
                     <tr>
                       <th>S/N</th>
                       <th>Admission Number</th>
                       <th>Section</th>
                       <th>Term</th>
                       <th>Session</th>
                       <th>Teller No</th>
                       <th>Amount</th>
                       <th>Cashier</th>
                       <th>Payment Date</th>
                     </tr>
                   </thead>
                   <tbody>
                    <?php
                    $sn=0;
                    foreach ($rows as $row) {
                      $sn++;
                      echo "<tr>
                            <td>".$sn."</td>
                            <td>".$row['admission_number']."</td>
                            <td>".$row['section']."</td>
                            <td>".$row['term']."</td>
                            <td>".$row['session']."</td>
                            <td>".$row['teller_no']."</td>
                            <td>".number_format($row['amount'])."</td>
                            <td>".$row['firstname']." ".$row['lastname']."</td>
                            <td>".$row['payment_date']."</td>
                          </tr>";
                    }

                    ?>
                   </tbody>
                 </table>
              </div>
        	    </div>
        	    <!-- /.card-body -->
        	</div>
        	<!-- /.card -->
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php 
 include 'templates/template_footer.php';
  ?>
 

 <script>
  $(function () {
    $("#fullpayment").DataTable({
      "ordering": false
    });
  });
</script>
