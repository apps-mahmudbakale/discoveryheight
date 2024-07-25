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
            <h1 class="m-0 text-dark">New Section Class</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
              <li class="breadcrumb-item"><a href="/sectionClass">SectionsClass</a></li>
              <li class="breadcrumb-item active">New Section Class</li>
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
        	<div class="card">
        	  <div class="card-header">
        	    <h3 class="card-title">Create New Section Class</h3>
        	  </div>
        	  <!-- /.card-header -->
               <div id="status"><br></div>
        	  <!-- form start -->
        	    <div class="card-body">
        	      <div class="form-group">
        	        <select name="section" id="section" class="form-control">
                      <?php 
                      $section = new Section();
                      $sections = $section->getSections();

                      foreach($sections as $row){
                          echo "<option value='{$row['section_id']}'>{$row['section']}</option>";
                      }
                       ?>
                  </select>
        	      </div>
                <div class="form-group">
                  <label>Class</label>
                  <select multiple name="sectionclass[]" id="sectionclass" class="custom-select">
                    <?php 
                    $class = new Classes();
                    $sectionclass = $class->getClasses();

                    foreach ($sectionclass as $row) 
                    {
                        echo "<option value={$row['class_id']}>{$row['class']}</option>";
                    }
                     ?>
                  </select>
                </div>
        	    </div>
        	    <!-- /.card-body -->

        	    <div class="card-footer">
        	      <button type="submit" id="addSectionClass" class="btn btn-primary">Submit</button>
        	    </div>
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
 

