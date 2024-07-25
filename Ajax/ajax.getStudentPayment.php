<?php 
include '../classes/Init.php';


$admno = $_POST['admno'];
$term = $_POST['term'];
$session = $_POST['session'];


$expl = explode("/", $admno);


$admNo = $expl[1]."/".$expl[2];

$config = array('host' => 'localhost', 'user' => 'mahmudbakale', 'pass' => 'root', 'db' => 'skul');
$db = new Sqli($config);
// $rows = $db->Row("SELECT * FROM student_payment WHERE admission_number ='$admNo'");
// $term = $rows['term'];
$row = $db->Row("SELECT * FROM `student` INNER JOIN class USING(class_id) INNER JOIN student_payment USING(admission_number) INNER JOIN applicant USING(app_id) INNER JOIN section USING(section_id) WHERE student.admission_number ='$admNo' AND student_payment.term ='$term' AND student_payment.session='$session' AND student_payment.status ='0'");

//print_r($row);

 ?>
 <?php if (!empty($row)): ?>
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
       <b>Invoice: MQS-<?php echo createRandomPassword(); ?>  </b><br>
       <br>
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
         	$fees = $db->Rows("SELECT * FROM `class_price` INNER JOIN class USING(class_id) INNER JOIN fees_item USING(fees_id) WHERE class_price.class_id ='$class_id' AND class_price.term ='$term'");
         	$sn=0;
          $total=0;
         	foreach ($fees as $item) {
         		$sn++;
            $total +=$item['price'];
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
       <button type="button" onclick="printDiv('pdf')" class="btn btn-primary float-right" style="margin-right: 5px;">
         <i class="fas fa-print"></i> Print Invoice
       </button>
     </div>
   </div>
 </div>
 <?php else: ?>
  <div class="alert alert-danger">
    <p class="text-center"><i class="fas fa-stop"></i> No Active Payment is Found</p>
  </div>
 <?php endif ?>
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
