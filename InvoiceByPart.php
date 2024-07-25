<?php  
include 'classes/Init.php';
include 'templates/template_header.php'; 
include 'templates/template_sidebar.php'; 
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">New Payment</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">New Payment</li>
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
              <h2>Payment Invoice</h2>
        	  </div>
        	  <!-- /.card-header -->
            
        	  <!-- form start -->
        	    <div class="card-body">
                <?php 
                $admNo = base64_decode($_GET['id']);

                $config = array('host' => 'localhost', 'user' => 'mahmudbakale', 'pass' => 'root', 'db' => 'skul');
                $db = new Sqli($config);
                $rows = $db->Row("SELECT * FROM student_payment WHERE admission_number ='$admNo'");
                $term = $rows['term'];
                $row = $db->Row("SELECT * FROM `student` INNER JOIN class USING(class_id) INNER JOIN student_payment USING(admission_number) INNER JOIN applicant USING(app_id) INNER JOIN section USING(section_id) WHERE student.admission_number ='$admNo' AND student_payment.term ='$term' AND student_payment.status ='0'");

                //print_r($row);

                 ?>
                 <!-- Main content -->
                 <div class="invoice p-3 mb-3">
                   <!-- title row -->
                   <div id="pdf">
                   <div class="row">
                     <div class="col-12">
                       <h2>
                         <img src="dist/img/logo.png" width="100" height="100">Maryam Quran Schools, Gusau.
                         <small class="float-right">Date: <?php echo date('d/m/Y') ?></small>
                       </h2>
                     </div>
                     <hr><br>
                     <br>
                     <!-- /.col -->
                   </div>
                   <!-- info row -->

                   <div class="row invoice-info">
                     <div class="col-sm-4 invoice-col">
                       From
                       <address>
                         <strong>Administration, Maryam Quran Schools, Gusau.</strong><br>
                         No.1 G.R.A Sokoto Road, Opposite Presidential Lodge.<br>
                         P.O Box 236, Gusau, Zamfara State<br>
                         Phone: 09039127993,07069149788<br>
                         Email: info@maryamquranschools.com.ng
                       </address>
                     </div>
                     <!-- /.col -->
                     <div class="col-sm-4 invoice-col">
                       To
                       <address>
                         <strong><?php echo $row['guardian_full_name'] ?></strong><br>
                         <?php echo $row['address'] ?>
                        <br>
                         Phone: <?php echo $row['phone']; ?><br>
                         Email: <?php echo $row['email'] ?>
                       </address>
                     </div>
                     <!-- /.col -->
                     <div class="col-sm-4 invoice-col">
                       <b>Invoice: <?php echo $invoice ="MQS-".createRandomPassword(); ?>  </b><br>
                       <br>
                       <br>
                       <b>Student: <?php echo $row['first_name']." ".$row['other_names']." (MQS/".$row['admission_number'].")" ?></b><br>
                       <b>Payment For:</b> <?php 
                        if ($term == '1') {
                             echo " First Term ".$row['class']." (".$row['section'].")<br>";
                        }elseif ($term == '2') {
                            echo " Second Term ".$row['class']." (".$row['section'].")<br>";
                        }elseif ($term == '3') {
                            echo " Third Term ".$row['class']." (".$row['section'].")<br>";
                        }
                    ?>
                     </div> 
                     <!-- /.col -->
                   </div>
                   <!-- /.row -->

                   <!-- Table row -->
                   <div class="row">
                     <div class="col-12 table-responsive">
                       <table class="table table-striped">
                         <thead>
                         <tr>
                           <th>S/N</th>
                           <th>Item</th>
                           <th>Subtotal</th>
                         </tr>
                         </thead>
                         <tbody>
                          <?php 
                          $class_id = $row['class_id'];
                          $fees = $db->Rows("SELECT * FROM `class_price` INNER JOIN temp_invoice USING(class_price_id) INNER JOIN fees_item USING(fees_id) WHERE class_price.class_id ='$class_id' AND class_price.term ='$term' AND temp_invoice.admno ='$admNo' AND temp_invoice.status ='0'");
                          $sn=0;
                          $total=0;
                          foreach ($fees as $item) {
                            $sn++;
                            $total +=$item['price'];
                            $tem_id = $item['tem_inv_id'];
                             $db->query("UPDATE temp_invoice SET status ='1', invoice ='$invoice' WHERE tem_inv_id ='$tem_id'");
                           ?>
                         <tr>
                           <td><?php echo $sn ?></td>
                           <td><?php echo $item['fees_name'] ?></td>
                           <td>&#8358; <?php echo number_format($item['price']); ?></td>
                         </tr>
                   <?php } ?>
                         </tbody>
                       </table>
                     </div>
                     <!-- /.col -->
                   </div>
                   <!-- /.row -->

                   <div class="row">
                     <!-- accepted payments column -->
                     <div class="col-6">
                       <p class="lead">Payment Methods:</p>
                       <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                        please take the given invoice to Bank And make payment to the Following Details, Abring Back the Teller to Us <br>
                        <table class="table">
                        <tr>
                          <td><b>Bank Name</b></td>
                          <td>FCMB</td>
                        </tr>
                        <tr>
                          <td>Account Name</td>
                          <td>Maryam Quran Schools</td>
                        </tr>
                        <tr>
                          <td>Account No</td>
                          <td>3942504015</td>
                        </tr>
                      </table>
                        Thank You.
                       </p>
                     </div>
                     <!-- /.col -->
                     <div class="col-6">
                       <p class="lead">Amount To be Paid</p>

                       <div class="table-responsive">
                         <table class="table">
                           <tr>
                             <th style="width:50%">Amount Total:</th>
                             <td>&#8358; <?php echo number_format($total); ?></td>
                           </tr>
                           <tr>
                             <th>Amount in Words:</th>
                             <td style="text-align: justify;"><?php $words = new NumberFormatter("En", NumberFormatter::SPELLOUT);
                                       echo  strtoupper($words->format($total))." NAIRA ONLY"; ?></td>
                           </tr>
                         </table>
                       </div>
                     </div>
                     <!-- /.col -->
                   </div>
                   <!-- /.row -->
                </div>
                   <!-- this row will not appear when printing -->
                   <div class="row no-print">
                     <div class="col-12">
                       <button type="button" onclick="payWithPaystack()" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Proceed to
                         Payment
                       </button>
                       <button type="button" onclick="printDiv('pdf');window.location='payment.create.php'" class="btn btn-primary float-right" style="margin-right: 5px;">
                         <i class="fas fa-print"></i> Print Invoice
                       </button>
                     </div>
                   </div>
                 </div>
                <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
                <script src='../dist/jspdf.debug.js'></script>
                 <script>
                function printDiv(id){
                        var printContents = document.getElementById(id).innerHTML;
                        var originalContents = document.body.innerHTML;
                        document.body.innerHTML = printContents;
                        window.print();
                        document.body.innerHTML = originalContents;
                }
                  </script>
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
  function payWithPaystack() {

  let handler = PaystackPop.setup({

    key: 'pk_test_30bbe756476a4c8b47a3df7a2201cd711b16ceb1', // Replace with your public key

    email: 'bakale.mahmud@gmail.com',

    amount: parseInt(2 * 100),

    firstname: 'Mahmud',

    lastname: 'Bakale',

    ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you

    // label: "Optional string that replaces customer email"

    onClose: function(){

      alert('Window closed.');

    },

    callback: function(response){

      let message = 'Payment complete! Reference: ' + response.reference;

      alert(message);

    }

  });

  handler.openIframe();

}
</script>