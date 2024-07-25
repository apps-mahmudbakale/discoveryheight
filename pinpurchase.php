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
                <h1>Pin Purchase</h1>
        	  </div>
        	  <!-- /.card-header -->
        	  <!-- form start -->
        	    <div class="card-body">
                     <table id="pinpurchase" class="table table-bordered table-striped">
                       <thead>
                         <th>S/N</th>
                         <th>Pin</th>
                         <th>Section</th>
                         <th>Cashier</th>
                       </thead>
                       <tbody>
                        <?php 
                          $pinpurchases = $payments->PinPurchase();
                          $sn=0;
                          $total =0;
                          foreach ($pinpurchases as $pinpurchase) { $sn++; $total += 1000;?>
                              
                            <tr>
                              <td><?php echo $sn; ?></td>
                              <td><?php echo MaskString($pinpurchase['pin']); ?></td>
                              <td><?php echo $pinpurchase['section'] ?></td>
                              <td><?php echo $pinpurchase['firstname']." ".$pinpurchase['lastname'] ?></td>
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
    $("#pinpurchase").DataTable({
      "ordering": false
    });
  });
</script>
