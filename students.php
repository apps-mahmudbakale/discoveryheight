<?php
session_start();
include 'classes/Init.php';
include 'templates/template_header.php';
include 'templates/template_sidebar.php';
$student = new Student();
// $student->section_id = $_SESSION['section'];
$students = $student->getStudents();
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Students</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Students</li>
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
                    <h3 class="card-title">Students</h3>
                    <a href="ApplicationForm.php" class="btn btn-primary float-right"><i class="fa fa-cloud-upload-alt"></i></a>
                    <a href="ApplicationForm.php" class="btn btn-success float-right"><i class="fa fa-plus-circle"></i></a>
                </div>
                <!-- /.card-header -->
                <div id="status"><br></div>
                <div class="card-body">
                    <table id="applicants" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Admission Number</th>
                            <th>Full Name</th>
                            <th>Gender</th>
                            <th>Class</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sn = 0;
                        foreach ($students as $row) {
                            $sn++;
                            echo "<tr>
                                <td>{$sn}</td>
                                <td>DH/{$row['app_id']}</td>
                                <td>{$row['other_names']} {$row['first_name']}</td>
                                <td>{$row['gender']}</td>
                                <td>{$row['class']}</td>
                                <td>
                                <div class='btn-group'>
                                <a href='viewApplicant.php?id=".base64_encode($row['app_id'])."' class='btn btn-info btn-sm'>
                                <i class='fa fa-eye'></i></a>
                                <button id='delete_{$row['app_id']}' class='btn btn-danger btn-sm delete'>
                                <i class='fa fa-trash'></i></button>";?>
                            <script>
                                $(document).ready(()=>{
                                    $('#delete_<?php echo $row['app_id'] ?>').click(()=>{
                                        var app_id = <?php echo $row['app_id'] ?>;

                                        $.confirm({
                                            title: 'Confirm!',
                                            content: 'Are You Sure to  Delete This Applicantion!',
                                            buttons: {
                                                confirm: function () {
                                                    $.ajax({
                                                        type: 'POST',
                                                        url: '../Ajax/application/ajax.del.application.php',
                                                        data:{app_id:app_id},
                                                        cache: false,
                                                        success: ((html)=>{
                                                            $('#status').html(html);
                                                        })
                                                    })
                                                },
                                                cancel: function () {

                                                }
                                            }
                                        });

                                    });
                                });
                            </script>
                            <?php  echo "</div>
                                </td>
                             </tr>";
                        }

                        ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
include 'templates/template_footer.php';
?>
<script>
    $(function () {
        $("#applicants").DataTable({
            "ordering": false
        });
    });
</script>

