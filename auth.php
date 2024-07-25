<?php
include 'classes/Init.php';
include 'templates/template_start.php'; 
 ?>
<!-- Login Container -->
<div id="login-container">
    <!-- Login Header -->
    <h1 class="h2 text-light text-center push-top-bottom animation-slideDown" style="margin-left: 15px; margin-bottom: 31px;">
        <img src="dist/img/stock-manager.fw.png"  class="img-responsive" alt="Maryam Quran Schools">
    </h1>
    <!-- END Login Header -->
    <!-- Login Block -->
    <div class="block animation-fadeInQuickInv">
        <!-- Login Title -->
        <div class="block-title">
            <h2>Please Login</h2>
        </div>
        <!-- END Login Title -->

        <!-- Login Form -->
        <form id="form-login" action="" method="post" class="form-horizontal">
        <?php 
       if (isset($_POST['submit'])) {
          session_start();
            $fields = array(
                array('name'=>'username',
                      'app_name' => 'Username',
                      'isRequired' => true
                     ),
                 array('name'=>'password',
                      'app_name' => 'Password',
                      'isRequired' => true
                     )
            );
$Validation = new Validation($fields,'POST');
if($Validation->out == 1) {
          $user = new User();
          $user->username = $_POST['username'];
          $user->password = $_POST['password'];
          $user->Auth();
        }else{
          errorArray($Validation->errors);
        }
      }

      if (isset($_GET['error']) && $_GET['error'] == 'true') {
          error('You need Authorization');
      }

      if (isset($_GET['page'])) {
        echo $_GET['page'];
      }
         ?>
            <div class="form-group">
                <div class="col-xs-12">
                    <input type="text" name="username" class="form-control" placeholder="Your Username..">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Your password..">
                </div>
            </div>
            <div class="form-group form-actions">
                <div class="col-xs-8">
                    <label class="csscheckbox csscheckbox-primary">
                        <input type="checkbox" id="login-remember-me" name="login-remember-me">
                        <span></span>
                    </label>
                    Remember Me?
                </div>
                <div class="col-xs-4 text-right">
                    <button type="submit" name="submit" class="btn btn-effect-ripple btn-sm btn-primary"><i class="fa fa-check"></i> Let's Go</button>
                </div>
            </div>
        </form>
        <!-- END Login Form -->
    </div>
    <!-- END Login Block -->

    <!-- Footer -->
    <footer class="text-muted text-center animation-pullUp">
        <small><span id="year-copy"></span> &copy; <a href="" target="_blank"><?php echo $template['name'] . ' ' . $template['version']; ?></a></small>
    </footer>
    <!-- END Footer -->
</div>
<!-- END Login Container -->

<?php include 'templates/template_scripts.php'; ?>

<!-- Load and execute javascript code used only in this page -->

<?php include 'templates/template_end.php'; ?>