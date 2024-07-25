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
            <h1 class="m-0 text-dark">Payment Confirmation</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Payment Confirmation</li>
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
                  <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Confirm Full Payment</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Confirm Payment By Part</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill" href="#custom-tabs-two-messages" role="tab" aria-controls="custom-tabs-two-messages" aria-selected="false">Confirm Discount Payment</a>
                </li>
              </ul>
        	  </div>
        	  <!-- /.card-header -->

        	  <!-- form start -->
        	    <div class="card-body">
                <div class="tab-content" id="custom-tabs-two-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                      <div class="form-group">
                        <?php 
                          $forms = new Form();
                        $forms->Input(array('label' =>'Student Admission Number', 'name' =>'admno', 'type'=>'text', 'id' => 'admno', 'class' => 'form-control', 'holder' =>'Student Admission Number', 'isDisabled' =>false, 'value' => '')); ?>
                      </div>
                      <div class="col-lg-12" id="data"></div>
                       <button type="submit" id="getStudentPayment" class="btn btn-primary">Search</button>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                    <div class="form-group">
                        <?php 
                          $forms = new Form();
                        $forms->Input(array('label' =>'Invoice Number', 'name' =>'admno', 'type'=>'text', 'id' => 'invoice', 'class' => 'form-control', 'holder' =>'Invoice Number', 'isDisabled' =>false, 'value' => '')); ?>
                      </div>
                      <div class="col-lg-12" id="dataByPart"></div>
                       <button type="submit" id="getPaymentByPart" class="btn btn-primary">Search</button>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-two-messages" role="tabpanel" aria-labelledby="custom-tabs-two-messages-tab">
                     <div class="form-group">
                        <?php 
                          $forms = new Form();
                        $forms->Input(array('label' =>'Student Admission Number', 'name' =>'admno', 'type'=>'text', 'id' => 'admno3', 'class' => 'form-control', 'holder' =>'Student Admission Number', 'isDisabled' =>false, 'value' => '')); ?>
                      </div>
                      <div class="col-lg-12" id="contByPart"></div>
                       <button type="submit" id="contPaymentByPart" class="btn btn-primary">Search</button>
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

    $.ajax({
              url: 'Ajax/ajax.getConfirmPayment.php',
              type: 'POST',
              data: {admno:admNo},
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
    var invoice = $('#invoice').val();

    $.ajax({
              url: 'Ajax/ajax.getConfirmPaymentByPart.php',
              type: 'POST',
              data: {invoice:invoice},
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

    $.ajax({
              url: 'Ajax/ajax.contPaymentByPart.php',
              type: 'POST',
              data: {admno:admNo},
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
</script>