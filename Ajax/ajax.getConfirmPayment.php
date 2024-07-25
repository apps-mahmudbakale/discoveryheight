<?php 
include '../classes/Init.php';


$admno = $_POST['admno'];


$expl = explode("/", $admno);


$admNo = $expl[1]."/".$expl[2];

$config = array('host' => 'localhost', 'user' => 'mahmudbakale', 'pass' => 'root', 'db' => 'skul');
$db = new Sqli($config);
$rows = $db->Row("SELECT * FROM student_payment WHERE admission_number ='$admNo'");
$term = $rows['term'];
$row = $db->Row("SELECT * FROM `student` INNER JOIN class USING(class_id) INNER JOIN student_payment USING(admission_number) INNER JOIN applicant USING(app_id) INNER JOIN section USING(section_id) WHERE student.admission_number ='$admNo' AND student_payment.term ='$term' AND student_payment.status ='0'");
  $class_id = $row['class_id'];
  $srow = $db->Row("SELECT SUM(price) AS total FROM `class_price` INNER JOIN class USING(class_id) INNER JOIN fees_item USING(fees_id) WHERE class_price.class_id ='$class_id' AND class_price.term ='$term'");

//print_r($row);

 ?>
 <!-- Main content -->
 <div class="invoice p-3 mb-3">
   <!-- title row -->
   <div id="pdf">
        <div class="row">
          <div class="col-md-6">
            Admission Number
            <input type="text" readonly id="admno" value="<?php echo $admno ?>" class="form-control">
          </div>
           <div class="col-md-6">
            Student Name
            <input type="text" readonly value="<?php echo strtoupper($row['first_name']." ".$row['other_names']) ?>" class="form-control">
          </div>
           <div class="col-md-6">
            Amount to Pay
            <input type="text" readonly id="amount" value="<?php echo number_format($srow['total']) ?>" class="form-control">
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
            <input type="text" name="teller" id="teller"  class="form-control">
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
 <script>
  $('#send').click(()=>{
    var admno = $('#admno').val();
    var amount = $('#amount').val();
    var teller = $('#teller').val();

     $.ajax({
              url: 'Ajax/ajax.getStudentReceipt.php',
              type: 'POST',
              data: {admno:admno,amount:amount,teller:teller},
              cache: false,
              success: ((html)=>{
                if (html != '') {
                  //console.log(html);
                  $('#data').html(html);
                  // $('#getStudentPayment').hide();
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
