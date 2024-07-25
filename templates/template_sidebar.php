<?php 
$role = new Role();
$perm = new Permission();
$roles = $role->getUserRole($_SESSION['user_id']);
$role_id = $roles['role_id'];
$perms = $perm->getRolePerms($role_id);
$perm->user_id = $_SESSION['user_id'];
$rowsub = $perm->getTeachingSubject();
$formClass = $perm->FormMasterClass();

 ?>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><?php echo @$template['sidebar_title']; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="dashboard.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
         <?php if ($perm->hasPerm('user_read',$perms)): ?>
         <li class="nav-item has-treeview">
           <a href="#" class="nav-link">
             <i class="nav-icon fas fa-users"></i>
             <p>
               Users Management
               <i class="right fas fa-angle-left"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
            <?php if ($perm->hasPerm('permission_read', $perms)): ?>
             <li class="nav-item">
               <a href="permissions.php" class="nav-link">
                 <i class="fa fa-candy-cane nav-icon"></i>
                 <p>Permissions</p>
               </a>
             </li>
             <?php endif ?>
             <?php if ($perm->hasPerm('role_read',$perms)): ?>
               
              <li class="nav-item">
               <a href="roles.php" class="nav-link">
                 <i class="fa fa-bomb nav-icon"></i>
                 <p>Roles</p>
               </a>
             </li>
             <?php endif ?>
             <li class="nav-item">
               <a href="users.php" class="nav-link">
                 <i class="fa fa-users nav-icon"></i>
                 <p>Users</p>
               </a>
             </li>
           </ul>
         </li>
         <?php endif ?>
         <?php if ($perm->hasPerm('staff_read',$perms)): ?>
         <li class="nav-item has-treeview">
           <a href="#" class="nav-link">
             <i class="nav-icon fas fa-book"></i>
             <p>
               Academics
               <i class="right fas fa-angle-left"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
            <?php if ($perm->hasPerm('staff_evaluation',$perms)): ?>
              <li class="nav-item ">
                <a href="class.php" class="nav-link">
                  <i class="nav-icon fas fa-university"></i>
                  <p>
                    Class
                  </p>
                </a>
              </li>
            <?php endif ?>
            <?php if ($perm->hasPerm('staff_data',$perms)): ?>
                <li class="nav-item">
                  <a href="students.php" class="nav-link">
                    <i class="nav-icon fa fa-graduation-cap"></i>
                    <p>Students</p>
                  </a>
              </li>
            <?php endif ?>
            <?php if ($perm->hasPerm('staff_data',$perms)): ?>
                <li class="nav-item">
                  <a href="" class="nav-link">
                    <i class="nav-icon fa fa-address-card"></i>
                    <p>Guardian</p>
                  </a>
              </li>
            <?php endif ?>
            <?php if ($perm->hasPerm('staff_attendance',$perms)): ?>
                <li class="nav-item">
                  <a href="subjects.php" class="nav-link">
                    <i class="nav-icon fa fa-book"></i>
                    <p>Subject</p>
                  </a>
              </li>
            <?php endif ?>
            <?php if ($perm->hasPerm('staff_attendance',$perms)): ?>
                <li class="nav-item">
                  <a href="" class="nav-link">
                    <i class="nav-icon fa fa-book"></i>
                    <p>New Term</p>
                  </a>
              </li>
            <?php endif ?>
           </ul>
         </li>
         <?php endif ?>
        <?php if ($perm->hasPerm('class_read',$perms)): ?>
         <li class="nav-item">
           <a href="class.php" class="nav-link">
             <i class="nav-icon fa fa-university"></i>
             <p>Classes</p>
           </a>
         </li>
        <?php endif ?>
        <?php if ($perm->hasPerm('subject_read',$perms)): ?>
          <li class="nav-item">
           <a href="subjects.php" class="nav-link">
             <i class="nav-icon fa fa-book"></i>
             <p>Sujects</p>
           </a>
         </li>
        <?php endif ?>
        
          <?php if ($perm->hasPerm('student_read',$perms)): ?>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-graduation-cap"></i>
                <p>
                  Manage Students
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="ApplicationForm.php" class="nav-link">
                    <i class="fa fa-graduation-cap nav-icon"></i>
                    <p>New Student</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="Applicants.php" class="nav-link">
                    <i class="fa fa-pencil-alt nav-icon"></i>
                    <p>Applicants</p>
                  </a>
                </li>
                 <li class="nav-item">
                  <a href="students.php" class="nav-link">
                    <i class="fa fa-table nav-icon"></i>
                    <p>Students</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="" class="nav-link">
                    <i class="fa fa-check-square nav-icon"></i>
                    <p>Veified Students</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="promotion.php" class="nav-link">
                    <i class="fa fa-magic nav-icon"></i>
                    <p>Promotion</p>
                  </a>
                </li>
              </ul>
            </li>
          <?php endif ?>
          <?php if ($perm->hasPerm('manage_teachers',$perms)): ?>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Manage Teachers
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="assignTeacherSubject.php" class="nav-link">
                    <i class="fa fa-ad nav-icon"></i>
                    <p>Assign Subject</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="assignFormMaster.php" class="nav-link">
                    <i class="fa fa-ad nav-icon"></i>
                    <p>Assign Form Master</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="teachers.php" class="nav-link">
                    <i class="fa fa-users nav-icon"></i>
                    <p>Teachers</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="FormMasters.php" class="nav-link">
                    <i class="fa fa-users nav-icon"></i>
                    <p>Form Masters</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="evaluation.create.php" class="nav-link">
                    <i class="fa fa-newspaper nav-icon"></i>
                    <p>Teachers Evalution</p>
                  </a>
                </li>
              </ul>
            </li>
          <?php endif ?>
          <?php if ($perm->hasPerm('fees_read',$perms)): ?>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-dollar-sign"></i>
                <p>
                  Fees Management
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="feesItem.php" class="nav-link">
                    <i class="fa fa-dollar-sign nav-icon"></i>
                    <p>Fees Items</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="classFees.php" class="nav-link">
                    <i class="fa fa-dollar-sign nav-icon"></i>
                    <p>Class Fees</p>
                  </a>
                </li>
              </ul>
            </li>
          <?php endif ?>
         <?php if ($perm->hasPerm('pin_read',$perms)): ?>
           <li class="nav-item has-treeview">
             <a href="#" class="nav-link">
               <i class="nav-icon fa fa-credit-card"></i>
               <p>
                 Pin Management
                 <i class="right fas fa-angle-left"></i>
               </p>
             </a>
             <ul class="nav nav-treeview">
               <li class="nav-item">
                 <a href="pins.generate.php" class="nav-link">
                   <i class="fa fa-random nav-icon"></i>
                   <p>Generate Pins</p>
                 </a>
               </li>
               <li class="nav-item">
                 <a href="pins.php" class="nav-link">
                   <i class="fa fa-table nav-icon"></i>
                   <p>Manage Pins</p>
                 </a>
               </li>
             </ul>
           </li>
         <?php endif ?>
         
         <?php if ($perm->hasPerm('payment_read',$perms)): ?>
           <li class="nav-item has-treeview">
             <a href="#" class="nav-link">
               <i class="nav-icon fa fa-money-bill"></i>
               <p>
                 Payments
                 <i class="right fas fa-angle-left"></i>
               </p>
             </a>
             <ul class="nav nav-treeview">
               <li class="nav-item">
                 <a href="payment.create.php" class="nav-link">
                   <i class="fa fa-plus-square nav-icon"></i>
                   <p>New Payment</p>
                 </a>
               </li>
               <li class="nav-item">
                 <a href="payment.confirm.php" class="nav-link">
                   <i class="fa fa-check-circle nav-icon"></i>
                   <p>Confirm Payment</p>
                 </a>
               </li>
               <li class="nav-item has-treeview">
                 <a href="#" class="nav-link">
                   <i class="fa fa-dollar-sign nav-icon"></i>
                   <p>
                    Manage Payments
                    <i class="right fas fa-angle-left"></i>
                   </p>
                 </a>
                 <ul class="nav nav-treeview">
                    <li class="nav-item">
                       <a href="fullpayments.php" class="nav-link">
                         <i class="fa fa-dollar-sign nav-icon"></i>
                         <p>Full Payment</p>
                       </a>
                     </li>
                     <li class="nav-item">
                       <a href="partpayments.php" class="nav-link">
                         <i class="fa fa-dollar-sign nav-icon"></i>
                         <p>Part Payment</p>
                       </a>
                     </li>
                     <li class="nav-item">
                       <a href="pinpurchase.php" class="nav-link">
                         <i class="fa fa-dollar-sign nav-icon"></i>
                         <p>Pin Purchase</p>
                       </a>
                     </li>
                 </ul>
               </li>
               <li class="nav-item">
                 <a href="payment.report.php" class="nav-link">
                   <i class="fa fa-chart-pie nav-icon"></i>
                   <p>Payments Report</p>
                 </a>
               </li>
             </ul>
           </li>
         <?php endif ?>
         <?php if ($perm->hasPerm('backup',$perms)): ?>
             <li class="nav-item">
               <a href="/backupdb" class="nav-link">
                 <i class="nav-icon fa fa-database"></i>
                 <p>Backup Data</p>
               </a>
           </li>
         <?php endif ?>
        <?php if ($perm->hasPerm('settings',$perms)): ?>
             <li class="nav-item">
               <a href="CurrentSession.php" class="nav-link">
                 <i class="nav-icon fa fa-cogs"></i>
                 <p>Current Session</p>
               </a>
           </li>
         <?php endif ?>

         <?php if ($perm->hasPerm('student_grade', $perms)): ?>

          <?php if ($perm->IsFormMaster()): ?>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-graduation-cap"></i>
                <p>
                  Manage Students
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                 <li class="nav-item">
                  <a href="students.php" class="nav-link">
                    <i class="fa fa-users nav-icon"></i>
                    <p>Students</p>
                  </a>
                </li>
                 <li class="nav-item">
                  <a href="recordAttendance.php" class="nav-link">
                    <i class="fa fa-check-square nav-icon"></i>
                    <p>Record Attendance</p>
                  </a>
                </li>
              </ul>
            </li>
             <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-paper-plane"></i>
                <p>
                  Manage Grades
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                 <li class="nav-item">
                  <a href="subjectGrading.php" class="nav-link">
                    <i class="fa fa-upload nav-icon"></i>
                    <p>Upload Grades</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="studentGrades.php" class="nav-link">
                    <i class="fa fa-list nav-icon"></i>
                    <p>Students Grades</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="studentReport.php" class="nav-link">
                    <i class="fa fa-table nav-icon"></i>
                    <p>Report</p>
                  </a>
                </li>
              </ul>
            </li>
            <?php else: ?>
               <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-paper-plane"></i>
                  <p>
                    Manage Grades
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                   <li class="nav-item">
                    <a href="subjectGrading.php" class="nav-link">
                      <i class="fa fa-upload nav-icon"></i>
                      <p>Upload Grades</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="studentGrades.php" class="nav-link">
                      <i class="fa fa-list nav-icon"></i>
                      <p>Students Grades</p>
                    </a>
                  </li>
                </ul>
              </li>
          <?php endif ?>
           
         <?php endif ?>
        <li class="nav-item">
          <a href="logout.php" class="nav-link">
            <i class="nav-icon fa fa-power-off"></i>
            <p>Logout</p>
          </a>
      </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>