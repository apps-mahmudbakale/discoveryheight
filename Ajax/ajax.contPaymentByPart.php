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
$row = $db->Row("SELECT * FROM `student` INNER JOIN class USING(class_id) INNER JOIN student_payment USING(admission_number) INNER JOIN applicant USING(app_id) INNER JOIN section USING(section_id) WHERE student.admission_number ='$admNo' AND student_payment.term ='$term' AND  student_payment.session='$session' AND student_payment.status ='0'");

//print_r($row);
 ?>
 <?php if (!empty($row)): ?>
 <!-- Main content -->
 <div class="invoice p-3 mb-3">
   <!-- title row -->
   <div id="pdf">
   <div class="row invoice-info">
     <div class="col-sm-12 invoice-col">
       <br>
       <h2><b>Payment By Part For:</b> <b><?php echo strtoupper($row['other_names']." ".$row['first_name']) ?> (<?php echo "MQS/".$row['admission_number'] ?>)</b> <?php 
       	if ($term == '1') {
       		   echo " First Term ".$row['class']." (".$row['section'].")<br>";
       	}elseif ($term == '2') {
       		  echo " Second Term ".$row['class']." (".$row['section'].")<br>";
       	}elseif ($term == '3') {
       		  echo " Third Term ".$row['class']." (".$row['section'].")<br>";
       	}
    ?>
</h2>
     </div> 
     <!-- /.col -->
   </div>
   <!-- /.row -->

   <!-- Table row -->
   <div class="row">
   <form action="" method="POST"  style="width: 100%" id="form">
     <div class="col-12 table-responsive">
       <table class="table table-striped">
         <thead>
         <tr>
           <th></th>
           <th>Item</th>
           <th>Subtotal</th>
         </tr>
         </thead>
         <tbody>
         	<?php 
         	$class_id = $row['class_id'];
         	$fees = $db->Rows("SELECT class_price.class_price_id,class_price.price, fees_item.fees_name FROM class_price
LEFT JOIN temp_invoice USING(class_price_id) INNER JOIN class USING(class_id) INNER JOIN fees_item USING(fees_id) WHERE temp_invoice.admno IS NULL AND class_price.class_id ='$class_id' AND class_price.term ='$term'");
         	$sn=0;
          $total=0;
         	foreach ($fees as $item) {
         		$sn++;
            $total +=$item['price'];
         	 ?>
         <tr>
           <td><input type="hidden" id="price<?php echo $sn?>" value="<?php echo $item['price'] ?>"><input  type='checkbox' id='checkbox-1-<?php echo $sn?>' class='regular-checkbox' name='co_ids[]' value='<?php echo $item[class_price_id]?>' ></td>
           <td><?php echo $item['fees_name'] ?></td>
           <td>&#8358; <?php echo number_format($item['price']); ?></td>
         </tr>
         <script>
           $('#checkbox-1-<?php echo $sn ?>').click(()=>{
            var price = $('#price<?php echo $sn ?>').val();
            var id = $('#checkbox-1-<?php echo $sn ?>').val();
            var admno = '<?php echo $admNo; ?>';
            $.ajax({
                      type: "POST",
                      url: "Ajax/ajax.get.php",
                      data: {price:price,id:id, admno:admno},
                      cache: false,
                      success: function(html)
                      {
                       console.log(html)
                        var json = JSON.parse(html);
                        if (json) {
                          console.log(json);
                            $('#total').html(json.total);
                            $('#text').html(json.text);
                        }
                         
                      }
                  });
           })
         </script>
   <?php } ?>
         </tbody>
       </table>
     </div>
     <!-- /.col -->
   </div>
   <!-- /.row -->

   <div class="row">
     <div class="col-12">
       <p class="lead">Amount To be Paid</p>

       <div class="table-responsive">
         <table class="table">
           <tr>
             <th style="width:50%">Amount Total:</th>
             <td>&#8358; <span id="total"></span></td>
           </tr>
           <tr>
             <th>Amount in Words:</th>
             <td style="text-align: justify;" id="text"></td>
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
       <button type="submit" id="submit" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Proceed to
         Invoice
       </button>
     </div>
   </div>
 </div>
</form>
<?php else: ?>
 <div class="alert alert-danger">
   <p class="text-center"><i class="fas fa-stop"></i> No Active Payment is Found</p>
 </div>
<?php endif ?>
<script>
  $('#submit').click(()=>{
    window.location='InvoiceByPart.php?id=<?php echo base64_encode($admNo) ?>';
  })
</script>
