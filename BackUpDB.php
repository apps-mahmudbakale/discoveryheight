<?php  
include 'classes/Init.php';
include 'templates/template_header.php'; 
include 'templates/template_sidebar.php'; 
$config = array('host' => 'localhost', 'user' => 'mahmudbakale', 'pass' => 'root', 'db' => 'skul');
$db = new Sqli($config);
$row = $db->Row("SELECT ROUND(SUM(table_rows)) size FROM information_schema.TABLES
                     WHERE table_schema='skul' GROUP BY table_schema");
$size = $row['size'];
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">BackUp DB</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
              <li class="breadcrumb-item active">BackUp DB</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        	<div class="card">
              <div class="card-header">
                <h3 class="card-title">BackUp DB</h3>
              </div>
              <!-- /.card-header -->
              <div id="status"><br></div>
              <div class="card-body">
                <fieldset>
                  <legend><i class='fa fa-database'></i> BACKUP DATABASE</legend>
                  Please be patient, backup may take minutes to complete. 
                  <input type="hidden" name="dbsize" value="<?php echo $size ?>" />
                  <div id="prg" class="progress progress-strip active">
                     <div id='eq' class="progress-bar" role="progress" aria-valuenow="20" aria-valuemin="0" 
                                aria-valuemax="100" >
                        <span class='sr-only'>20%</span>
                     </div>
                  </div>
                  <br>
                  <button id="btn" class='btn btn-default'> <i class='fa fa-database'></i> Start Backup</button>
                </fieldset>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <script type="text/javascript">
   function sendRequest() {
        $.ajax({
          url:'ajaxDbBackup.php'
        })
   }
   function getPers() {
    $.ajax({
          url:'Ajax/ajaxDb.php?size='+$('input[name=dbsize]').val(),
          success:function(r){
                $('#eq').css('width',r+'%');
                $('#eq').html(r+'%');
                if(r == 100) {
                   //$('#eq').html('Backup');
                }
          }
        }).ajaxComplete(function(e){
           //$('#eq').css('width','100%');
               //$('#eq').html('100%');
        })
   }
  $(function(e){
    $('#btn').click(function(e){
          sendRequest();
          setInterval("getPers()",10);
    })
  })

  </script>
  <!-- /.content-wrapper -->
 <?php 
 include 'templates/template_footer.php';
  ?>
 <script>
  $(function () {
    $("#permissions").DataTable({
      "ordering": false
    });
  });
</script>

