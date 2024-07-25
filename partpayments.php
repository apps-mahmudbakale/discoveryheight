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
                <h1>Part Payments</h1>
        	  </div>
        	  <!-- /.card-header -->
        	  <!-- form start -->
        	    <div class="card-body">
                     <table id="partpayment" class="table table-bordered table-striped">
                       <thead>
                         <th>S/N</th>
                         <th>Name</th>
                         <th>Admission Number</th>
                         <th>Section</th>
                         <th>Class</th>
                         <th>Term</th>
                         <th>Amount</th>
                         <th>Invoice</th>
                         <th>Teller No</th>
                         <th>Cashier</th>
                       </thead>
                       <tbody>
                        <?php 
                          $partpayments = $payments->ByPartPayments();
                          $sn=0;
                          $total =0;
                          foreach ($partpayments as $partpayment) { $sn++; $total +=str_replace(",", "", $partpayment['amount_paid']);?>
                              
                            <tr>
                              <td><?php echo $sn; ?></td>
                              <td><?php echo $partpayment['first_name']." ".$partpayment['other_names']; ?></td>
                              <td><?php echo "MQS/".$partpayment['admission_number']; ?></td>
                              <td><?php echo $partpayment['section'] ?></td>
                              <td><?php echo $partpayment['class'] ?></td>
                              <td>
                                <?php 
                                  $term = $partpayment['term'];
                                  if ($term == '1') {
                                       echo strtoupper("First Term");
                                  }elseif ($term == '2') {
                                      echo strtoupper("Second Term");
                                  }elseif ($term == '3') {
                                      echo strtoupper("Third Term");
                                  }
                                 ?>
                              </td>
                              <td>&#8358; <?php echo number_format(str_replace(",", "", $partpayment['amount_paid'])) ?></td>
                              <td><?php echo $partpayment['invoice']; ?></td>
                              <td><?php echo $partpayment['teller_no'] ?></td>
                              <td><?php echo $partpayment['firstname']." ".$partpayment['lastname'] ?></td>
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
    $("#partpayment").DataTable({
      "ordering": false
    });
  });
</script>
