<?php  
include 'classes/Init.php';
include 'templates/template_header.php'; 
include 'templates/template_sidebar.php';
$payments = new Payment(); 
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
                <h1>Full Payments</h1>
        	  </div>
        	  <!-- /.card-header -->
        	  <!-- form start -->
        	    <div class="card-body">
                     <table id="fullpayment" class="table table-bordered table-striped">
                       <thead>
                         <th>S/N</th>
                         <th>Name</th>
                         <th>Admission Number</th>
                         <th>Section</th>
                         <th>Class</th>
                         <th>Term</th>
                         <th>Amount</th>
                         <th>Teller No</th>
                         <th>Cashier</th>
                       </thead>
                       <tbody>
                        <?php 
                          $fullpayments = $payments->FullPayments();
                          $sn=0;
                          $total =0;
                          foreach ($fullpayments as $fullpayment) { $sn++; $total +=str_replace(",", "", $fullpayment['amount']);?>
                              
                            <tr>
                              <td><?php echo $sn; ?></td>
                              <td><?php echo $fullpayment['first_name']." ".$fullpayment['other_names']; ?></td>
                              <td><?php echo "MQS/".$fullpayment['admission_number']; ?></td>
                              <td><?php echo $fullpayment['section'] ?></td>
                              <td><?php echo $fullpayment['class'] ?></td>
                              <td>
                                <?php 
                                  $term = $fullpayment['term'];
                                  if ($term == '1') {
                                       echo strtoupper("First Term");
                                  }elseif ($term == '2') {
                                      echo strtoupper("Second Term");
                                  }elseif ($term == '3') {
                                      echo strtoupper("Third Term");
                                  }
                                 ?>
                              </td>
                              <td>&#8358; <?php echo number_format(str_replace(",", "", $fullpayment['amount'])) ?></td>
                              <td><?php echo $fullpayment['teller_no'] ?></td>
                              <td><?php echo $fullpayment['firstname']." ".$fullpayment['lastname'] ?></td>
                            </tr>
                              
                        <?php }?>
                       </tbody>
                     </table>
                     <table class="table">
                     <tr>
                       <td>Total:</td>
                       <td>&#8358; <?php echo number_format($total) ?></td>
                       <td>Amount in word</td>
                       <td><?php $words = new NumberFormatter("En", NumberFormatter::SPELLOUT);
                          echo  strtoupper($words->format($total))." NAIRA ONLY"; ?>
                          </td>
                     </tr>
                   </table>
  
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
