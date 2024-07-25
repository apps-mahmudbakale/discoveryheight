<?php 
include_once 'classes/Init.php';
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
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php if (empty($_SESSION['section'])): ?>
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fa fa-graduation-cap"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Students</span>
                <span class="info-box-number">
                  <?php echo $count = $db->NumRows("SELECT * FROM student") ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-university"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Classes</span>
                <span class="info-box-number"><?php echo $count = $db->NumRows("SELECT * FROM class") ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-building"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Sections</span>
                <span class="info-box-number"><?php echo $count = $db->NumRows("SELECT * FROM section") ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Staff</span>
                <span class="info-box-number"><?php echo $count = $db->NumRows("SELECT * FROM users WHERE section_id IS NOT NULL") ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-6">
            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Section Statistics</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>Section</th>
                      <th>Classes</th>
                      <th>Students</th>
                      <th>Staff</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>Secondary</td>
                      <td><?php //echo $count = $db->NumRows("SELECT * FROM `section_class` INNER JOIN section USING(section_id) WHERE section.section_id ='3' OR section.section ='Secondary'"); ?></td>
                      <td><span class="badge badge-success"><?php //echo $count = $db->NumRows("SELECT * FROM `applicant` INNER JOIN student USING(app_id) WHERE applicant.section_id ='3'") ?></span></td>
                      <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20"><?php //echo $count = $db->NumRows("SELECT * FROM `users` INNER JOIN user_role USING(user_id) INNER JOIN roles USING(role_id) WHERE users.section_id='3' AND roles.role !='Headmaster'"); ?></div>
                      </td>
                    </tr>
                    <tr>
                      <td>Primary</td>
                      <td><?php //echo $count = $db->NumRows("SELECT * FROM `section_class` INNER JOIN section USING(section_id) WHERE section.section_id ='1' OR section.section ='Primary'"); ?></td>
                      <td><span class="badge badge-warning"><?php //echo $count = $db->NumRows("SELECT * FROM `applicant` INNER JOIN student USING(app_id) WHERE applicant.section_id ='1'") ?></span></td>
                      <td>
                        <div class="sparkbar" data-color="#f39c12" data-height="20"><?php //echo $count = $db->NumRows("SELECT * FROM `users` INNER JOIN user_role USING(user_id) INNER JOIN roles USING(role_id) WHERE users.section_id='1' AND roles.role !='Principal'"); ?></div>
                      </td>
                    </tr>
                    <tr>
                      <td>Tahfeez</td>
                      <td><?php //echo $count = $db->NumRows("SELECT * FROM `section_class` INNER JOIN section USING(section_id) WHERE section.section_id ='2' OR section.section ='Tahfeez'"); ?></td>
                      <td><span class="badge badge-danger"><?php //echo $count = $db->NumRows("SELECT * FROM `applicant` INNER JOIN student USING(app_id) WHERE applicant.section_id ='2'") ?></span></td>
                      <td>
                        <div class="sparkbar" data-color="#f56954" data-height="20"><?php //echo $count = $db->NumRows("SELECT * FROM `users` INNER JOIN user_role USING(user_id) INNER JOIN roles USING(role_id) WHERE users.section_id='2' AND roles.role !='Mudeer'"); ?></div>
                      </td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-6">
            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Tahfeez Levels Info</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>Class</th>
                      <th>Level</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>Abubakar - Khadjia</td>
                      <td>21,30,50,60 (Hizb)</td>
                    </tr>
                    <tr>
                      <td>Umar - Aisha</td>
                      <td>10,15,20 (Hizb)</td>
                    </tr>
                    <tr>
                      <td>Usman - Hafsat</td>
                      <td>5, 6, 9 (Hizb)</td>
                    </tr>
                    <tr>
                      <td>Aliyu - Ummu Khande - Ramla</td>
                      <td>2,3, 4 (Hizb)</td>
                    </tr>
                    <tr>
                      <td>Nahuce I - Nahuce II</td>
                      <td>1/2, 1 (Hizb)</td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <?php else: ?>
          <h2 align="center"><img src="dist/img/logo.png" width="200" height="200"></h2>
            <h2 align="center"> MARYAM QURAN SCHOOLS, GUSAU, ZAMFARA STATE</h2>
        <?php endif ?>
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <?php 
 include 'templates/template_footer.php';
  ?>