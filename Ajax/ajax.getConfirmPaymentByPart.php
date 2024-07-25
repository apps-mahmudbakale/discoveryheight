<?php 
include '../classes/Init.php';


$invoice = $_POST['invoice'];

$config = array('host' => 'localhost', 'user' => 'mahmudbakale', 'pass' => 'root', 'db' => 'skul');
$db = new Sqli($config);
$rows = $db->Row("SELECT * FROM student_payment INNER JOIN temp_invoice ON student_payment.admission_number = temp_invoice.admno WHERE temp_invoice.invoice ='$invoice' AND temp_invoice.status='1'");
$term = $rows['term'];
if (!empty($rows)) {
  $row = $db->Row("SELECT applicant.first_name, applicant.other_names, SUM(temp_invoice.price) AS sum, class.class,class.class_id,section.section,student.admission_number FROM student INNER JOIN student_payment USING(admission_number) INNER JOIN applicant USING(app_id) INNER JOIN class USING(class_id) INNER JOIN section USING(section_id) INNER JOIN temp_invoice ON student_payment.admission_number = temp_invoice.admno WHERE student_payment.status ='0' OR student_payment.status='1' AND student_payment.term ='$term' AND temp_invoice.invoice ='$invoice' AND temp_invoice.status = '1'");
$class = $row['class_id'];

//print_r($row);
$am = $db->Row("SELECT SUM(price) AS sum FROM `class_price` INNER JOIN class USING(class_id) INNER JOIN fees_item USING(fees_id) WHERE class_price.class_id ='$class' AND class_price.term ='$term'");

$sum = $am['sum'];

}else{

}

//print_r($row);
 ?>
 <?php if (empty($rows)): ?>
   <div class="alert alert-danger">No Payment for this Invoice</div>
 <?php else: ?>
<div class="invoice p-3 mb-3">
   <!-- title row -->
   <div id="pdf">
        <div class="row">
          <div class="col-md-6">
            Invoice Number
            <input type="text" readonly id="invoice" value="<?php echo $invoice ?>" class="form-control">
          </div>
          <div class="col-md-6">
            Admission Number
            <input type="text" readonly  value="<?php echo "MQS/".$row['admission_number'] ?>" class="form-control">
          </div>
           <div class="col-md-6">
            Student Name
            <input type="text" readonly value="<?php echo strtoupper($row['first_name']." ".$row['other_names']) ?>" class="form-control">
          </div>
           <div class="col-md-6">
            Amount to Pay
            <input type="text" readonly id="amount" value="<?php echo number_format($row['sum']) ?>" class="form-control">
          </div>
           <div class="col-md-6">
            Class
            <input type="text" readonly value="<?php echo $row['class']?>" class="form-control">
          </div>
           <div class="col-md-6">
            Section
            <input type="text" readonly value="<?php echo $row['section']?>" class="form-control">
          </div>
           <div class="col-md-6">
            Teller No:
            <input type="text" name="teller" id="tellerno"  class="form-control">
          </div>
          <br>
        </div>
    </div>
   <!-- this row will not appear when printing -->
   <div class="row no-print">
    <br>
     <div class="col-12">
      <br>
       <button type="button" id="send" class="btn btn-primary float-right" style="margin-right: 5px;">
         <i class="fa fa-right-arrow"></i> Get Receipt
       </button>
     </div>
   </div>
 </div>
 <?php endif ?>
 <script>
  $('#send').click(()=>{
    var invoice = $('#invoice').val();
    var amount = $('#amount').val();
    var tellerno = $('#tellerno').val();
     $.ajax({
              url: 'Ajax/ajax.getByPartReceipt.php',
              type: 'POST',
              data: {invoice:invoice,amount:amount,tellerno:tellerno},
              cache: false,
              success: ((html)=>{
                if (html != '') {
                  //console.log(html);
                  $('#pdf').html(html);
                  $('#send').hide();
                  // $('.form-group').hide();
                }
                  
              })
            });
  })
function printDiv(id){
        var printContents = document.getElementById(id).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
}
  </script>