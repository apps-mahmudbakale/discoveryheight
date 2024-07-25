<?php 
session_start();
include '../classes/Init.php';


$invoice = $_POST['invoice'];

$config = array('host' => 'localhost', 'user' => 'mahmudbakale', 'pass' => 'root', 'db' => 'skul');
$db = new Sqli($config);
$rows = $db->Row("SELECT * FROM student_payment INNER JOIN temp_invoice ON student_payment.admission_number = temp_invoice.admno WHERE temp_invoice.invoice ='$invoice' AND temp_invoice.status='1'");
$term = $rows['term'];
$row = $db->Row("SELECT applicant.first_name, applicant.other_names,class.class,class.class_id,section.section,student.admission_number, applicant.guardian_full_name FROM student INNER JOIN student_payment USING(admission_number) INNER JOIN applicant USING(app_id) INNER JOIN class USING(class_id) INNER JOIN section USING(section_id) INNER JOIN temp_invoice ON student_payment.admission_number = temp_invoice.admno WHERE student_payment.status ='0' OR student_payment.status='1' AND student_payment.term ='$term' AND temp_invoice.invoice ='$invoice' AND temp_invoice.status = '1'");
$admNo = $row['admission_number'];
$class = $row['class_id'];
$section_id = $_SESSION['section'];
$user_id = $_SESSION['user_id']; 
$teller = $_POST['tellerno'];
$amount = str_replace(",", "", $_POST['amount']);
$am = $db->Row("SELECT SUM(price) AS sum FROM `class_price` INNER JOIN class USING(class_id) INNER JOIN fees_item USING(fees_id) WHERE class_price.class_id ='$class' AND class_price.term ='$term'");
$sum = $am['sum'];
$db->query("INSERT INTO `varified_part_payment`(`v_p_id`, `user_id`, `section_id`, `invoice`, `amount`, `amount_paid`, `teller_no`) VALUES (NULL,'$user_id','$section_id','$invoice','$sum','$amount','$teller')");
$dd = $db->Row("SELECT * FROM users WHERE user_id ='$user_id'");
$db->query("UPDATE student_payment SET status ='1' WHERE admission_number ='$admNo' AND term ='$term'");
$db->query("UPDATE temp_invoice SET status ='2' WHERE invoice ='$invoice'");
//print_r($row);
 ?>
 <!-- Main content -->
 <div class="invoice p-3 mb-3">
   <!-- title row -->
   <div id="pdf">
   <div class="row invoice-info">
     <div class="col-sm-12">
       <br>
       <h1 align="center">
         <img src="dist/img/logo.png" width="100" height="100" align="center">
         <br>
         MARYAM QURAN SCHOOLS, GUSAU.
         <br> 
         <small class="text-center">TAHFEEZ, NURSERY, PRIMARY & SECONDARY SCHOOLS</small>
       </h1>
     </div> 
     <!-- /.col -->
   </div>
   <!-- /.row -->
      <hr><h4 align="center">PAYMENT RECEIPT</h4><hr>
   <!-- Table row -->
   <div class="row">
     <div class="col-12 table-responsive">
        <table class="table">
          <tr>
            <td><b>NAME</b></td>
            <td><?php echo strtoupper($row['first_name']." ".$row['other_names']) ?></td>
            <td>INVOICE NO:</td>
            <td><?php echo $invoice ?></td>
          </tr>
          <tr>
            <td><b>ADMISSION NUMBER</b></td>
            <td><?php echo "MSQ/".$row['admission_number']; ?></td>
            <td><b>CLASS</b></td>
            <td><?php echo $row['class']; ?></td>
          </tr>
          <tr>
            <td><b>TERM</b></td>
            <td>
              <?php 
                if ($term == '1') {
                     echo strtoupper("First Term");
                }elseif ($term == '2') {
                    echo strtoupper("Second Term");
                }elseif ($term == '3') {
                    echo strtoupper("Third Term");
                }
               ?>
                
            </td>
            <td><b>TELLER NO</b></td>
            <td><?php echo $_POST['tellerno'] ?></td>
          </tr>
          <tr>
            <td><b>DATE</b></td>
            <td><?php echo date('d/m/Y'); ?></td>
          </tr>
        </table>
        <table class="table table-bordered">
          <thead>
            <th>DESCRIPTION</th>
            <th>AMOUNT</th>
            <th>BALANCE</th>
          </thead>
          <tbody>
            <tr>
              <td>
                <?php 
                $am2 = $db->Row("SELECT SUM(price) AS paid FROM temp_invoice WHERE admno='$admNo' AND status='2'");
                $sum2 = $am2['paid'];
                if ($term == '1') {
                     echo strtoupper("First Term School fees");
                }elseif ($term == '2') {
                    echo strtoupper("Second Term school fees");
                }elseif ($term == '3') {
                    echo strtoupper("Third Term school fees");
                }
               ?>
              </td>
              <td><?php echo $_POST['amount'] ?></td>
              <?php if ($sum == $sum2): ?>
                <td>0</td>
              <?php else: ?>
                <td><?php $d = $sum - str_replace(",", "", $_POST['amount']); echo number_format($d); ?></td>
              <?php endif ?>
            </tr>
          </tbody>
        </table>
        <table class="table">
          <tr>
            <td>AMOUNT IN WORDS</td>
            <td><?php $words = new NumberFormatter("En", NumberFormatter::SPELLOUT);
                echo  strtoupper($words->format(str_replace(",", "",$_POST['amount'])))." NAIRA ONLY"; ?> 
            </td>
          </tr>
        </table>
        <hr>
     </div>
     <!-- /.col -->
        <span class="col-md-3 float-left text-center">
          <?php echo strtoupper($row['guardian_full_name']) ?>
          <hr>
          Depositor
        </span>
        <span class="col-md-3"></span>
         <span class="col-md-3 float-right text-center">
          <?php echo strtoupper($dd['firstname']." ".$dd['lastname']); echo $admno; ?>
          <hr>
          Cashier
        </span>
   </div>
   <!-- /.row -->
</div>
   <!-- this row will not appear when printing -->
   <div class="row no-print">
     <div class="col-12">
       <button type="submit" onclick="printDiv('pdf');window.location='payment.confirm.php'" class="btn btn-success float-right"><i class="fa fa-print"></i> Print Receipt
       </button>
     </div>
   </div>
 </div>
</form>

<script>
  function printDiv(id){
     var printContents = document.getElementById(id).innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     window.print();
     document.body.innerHTML = originalContents;
}
</script>
