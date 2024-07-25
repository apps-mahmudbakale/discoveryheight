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
        	<div class="card card-outline card-tabs">
        	  <div class="card-header p-0 pt-1 border-bottom-0">
              <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">New Full Payment</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">New Payment By Part</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill" href="#custom-tabs-two-messages" role="tab" aria-controls="custom-tabs-two-messages" aria-selected="false">Continue Part Payment</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-two-settings-tab" data-toggle="pill" href="#custom-tabs-two-settings" role="tab" aria-controls="custom-tabs-two-settings" aria-selected="false">Discount Payment</a>
                </li>
              </ul>
        	  </div>
        	  <!-- /.card-header -->

        	  <!-- form start -->
        	    <div class="card-body">
                <div class="tab-content" id="custom-tabs-two-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                      <div class="form-group col row">
                        <div class="col-lg-4">
                          Student Admission Number
                          <input type="text" name="admno" id="admno" class="form-control" placeholder="Student Admission Number">
                        </div>
                        <div class="col-lg-4">
                          Term
                          <select name="term" id="term" class="form-control">
                            <?php
                              for($x=1; $x<=3; $x++) {
                                
                                echo "<option>".$x."</option>";
                              }
                             ?>
                          </select>
                        </div>
                         <div class="col-lg-4">
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
                      </div>
                      <div class="col-lg-12" id="data"></div>
                       <button type="submit" id="getStudentPayment" class="btn btn-primary">Search</button>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                   <div class="form-group col row">
                     <div class="col-lg-4">
                       Student Admission Number
                       <input type="text" name="admno" id="admno2" class="form-control" placeholder="Student Admission Number">
                     </div>
                     <div class="col-lg-4">
                       Term
                       <select name="term" id="term2" class="form-control">
                         <?php
                           for($x=1; $x<=3; $x++) {
                             
                             echo "<option>".$x."</option>";
                           }
                          ?>
                       </select>
                     </div>
                      <div class="col-lg-4">
                       Session
                       <select name="session" id="session2" class="form-control">
                         <?php
                           for($x=2011; $x<=date('Y'); $x++) {
                             echo "<option ";
                             echo ($x == date('Y')) ? " selected " : " ";
                             echo ">". ($x)."/".($x+1)."</option>";
                           }
                         ?>
                       </select>
                     </div>
                   </div>
                      <div class="col-lg-12" id="dataByPart"></div>
                       <button type="submit" id="getPaymentByPart" class="btn btn-primary">Search</button>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-two-messages" role="tabpanel" aria-labelledby="custom-tabs-two-messages-tab">
                     <div class="form-group col row">
                       <div class="col-lg-4">
                         Student Admission Number
                         <input type="text" name="admno" id="admno3" class="form-control" placeholder="Student Admission Number">
                       </div>
                       <div class="col-lg-4">
                         Term
                         <select name="term" id="term3" class="form-control">
                           <?php
                             for($x=1; $x<=3; $x++) {
                               
                               echo "<option>".$x."</option>";
                             }
                            ?>
                         </select>
                       </div>
                        <div class="col-lg-4">
                         Session
                         <select name="session" id="session3" class="form-control">
                           <?php
                             for($x=2011; $x<=date('Y'); $x++) {
                               echo "<option ";
                               echo ($x == date('Y')) ? " selected " : " ";
                               echo ">". ($x)."/".($x+1)."</option>";
                             }
                           ?>
                         </select>
                       </div>
                     </div>
                      <div class="col-lg-12" id="contByPart"></div>
                       <button type="submit" id="contPaymentByPart" class="btn btn-primary">Search</button>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-two-settings" role="tabpanel" aria-labelledby="custom-tabs-two-settings-tab">
                     <table class="table table-striped" id="families">
                        <thead>
                          <tr>
                             <th>S/N</th>
                             <th>Family</th>
                             <th>Students</th>
                             <th></th>
                         </tr>
                       </thead>
                       <tbody>
                         <?php 
                            $sn=0;
                            if (isset($_SESSION['section'])) {
                              $section = $_SESSION['section'];
                              $rows = $db->Rows("SELECT DISTINCT(guardian_full_name) AS family, COUNT(*) AS students FROM applicant INNER JOIN student USING(app_id) WHERE section_id='$section' GROUP BY guardian_full_name");
                            }else{
                              $rows = $db->Rows("SELECT DISTINCT(guardian_full_name) AS family, COUNT(*) AS students FROM applicant INNER JOIN student USING(app_id) GROUP BY guardian_full_name");
                            }
                            

                              foreach ($rows as $row) {
                                $sn++;
                                echo "<tr>
                                    <td>".$sn."</td>
                                    <td>".$row['family']."</td>
                                    <td>".$row['students']."</td>";
                                    if ($row['students'] >= 5) 
                                    echo "<td><a href='discount.payment.php?family=".base64_encode($row['family'])."' class='btn btn-info'><i class='fa fa-sign-in-alt'></i></a></td>";
                                  else
                                    echo "<td><label class='badge badge-danger'>not qualified</label></td>";

                                echo"</tr>";
                              }
                          ?>
                       </tbody>
                     </table>
                  </div>
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
  $('#getStudentPayment').click(()=>{
    var admNo = $('#admno').val();
    var term = $('#term').val();
    var session = $('#session').val();

    $.ajax({
              url: 'Ajax/ajax.getStudentPayment.php',
              type: 'POST',
              data: {admno:admNo,term:term,session:session},
              cache: false,
              success: ((html)=>{
                if (html != '') {
                  //console.log(html);
                  $('#data').html(html);
                  $('#getStudentPayment').hide();
                  $('.form-group').hide();
                }
                  
              })
            });
  });

    $('#getPaymentByPart').click(()=>{
    var admNo = $('#admno2').val();
    var term = $('#term2').val();
    var session = $('#session2').val();

    $.ajax({
              url: 'Ajax/ajax.getPaymentByPart.php',
              type: 'POST',
              data: {admno:admNo,term:term,session:session},
              cache: false,
              success: ((html)=>{
                if (html != '') {
                  //console.log(html);
                  $('#dataByPart').html(html);
                  $('#getPaymentByPart').hide();
                  $('.form-group').hide();
                }
                  
              })
            });
  });

    $('#contPaymentByPart').click(()=>{
    var admNo = $('#admno3').val();
    var term = $('#term3').val();
    var session = $('#session3').val();

    $.ajax({
              url: 'Ajax/ajax.contPaymentByPart.php',
              type: 'POST',
              data: {admno:admNo,term:term,session:session},
              cache: false,
              success: ((html)=>{
                if (html != '') {
                  //console.log(html);
                  $('#contByPart').html(html);
                  $('#contPaymentByPart').hide();
                  $('.form-group').hide();
                }
                  
              })
            });
  });

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
  $(function () {
    $("#families").DataTable({
      "ordering": false
    });
  });
</script>