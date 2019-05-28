<?php
/**
 * Created by PhpStorm.
 * User: CollyneJumah
 * Date: 01/09/2019
 * Time: 08:40
 */
require_once ('links.php');
@session_start();

if(strlen($_SESSION['user'] || strlen($_SESSION['role']))==0)
{
    echo '<script>window.location="../users/sign-in.php"</script>';
}

?>

<!---=============================Register user data and save to db================-->
<?php

$description=$file_name=$file=$msg='';
require_once('connection.php');

if(isset($_POST['submitFiles'])) {
    $file_name=mysqli_real_escape_string($conn,$_POST['file_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $files=$_FILES['files']['name'];
    $fileTemp=$_FILES['files']['tmp_name'];
    $path="../postFiles/".basename($files);





//    $file_extension = pathinfo($files, PATHINFO_EXTENSION);
    $extension = end($temp);
    $allowedExts = array("pdf", "doc");

    if ($_FILES['files']['type'] != "application/pdf") {
        echo "<p>file must be uploaded in pdf.</p>";
    }
if(!in_array($extension,$allowedExts)) {
    $msg='Only pdf and doc files';
}

    $sql = "INSERT INTO noticeboard_files(file_name,description,files)VALUES('$file_name','$description','$files')";
    $result = mysqli_query($conn, $sql);
    if ($result) {

        move_uploaded_file($_FILES["files"]["tmp_name"], "../postFiles/" . $_FILES["files"]["name"]);
        $msg = '<div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert">&times;</a>
                   <strong>Success!</strong> File uploaded!</b>
                </div>';
        echo "<script> setTimeout(function () {
             window.location.href= 'fileUploads.php'; // the redirect goes here
             },5000);</script>";

    } else {
        $msg = "<div class='alert alert-danger fade in'><a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>Error while uploading file!</div>" . mysqli_error($conn);
    }



}

?>
<!DOCTYPE html>
<html>
<head>
    <!-- Bootstrap Select Css -->
    <link href="../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
</head>
<body class="theme-red">
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="preloader">
            <div class="spinner-layer pl-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <p>Please wait...</p>
    </div>
</div>
<!-- #END# Page Loader -->
<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<!-- #END# Overlay For Sidebars -->
<!-- Search Bar -->
<div class="search-bar">
    <div class="search-icon">
        <i class="material-icons">search</i>
    </div>
    <input type="text" placeholder="START TYPING...">
    <div class="close-search">
        <i class="material-icons">close</i>
    </div>
</div>
<!-- #END# Search Bar -->
<!-- Top Bar -->
<?php require_once ('topNav.php')?>
<!-- #Top Bar -->
<?php require_once ('sidebar.php')?>
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>FILE UPLOAD</h2>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <i class="material-icons"></i>
                        <h2>Upload Files</h2>
                    </div>
                    <div class="body">
                        <div class="card card-panel">
                            <div class="body">
                                <form id="sign_in" method="POST" action="fileUploads.php" enctype="multipart/form-data" autocomplete="off">
                                    <span><?php echo $msg?></span>
                                    <div class="col-sm-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="file_name" name="file_name" class="form-control" required>
                                                <label for="file_name" class="form-label">File Name:</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <textarea type="text" id="description" cols="20" rows="4" name="description" class="form-control" required></textarea>
                                                <label for="description" class="form-label">Description:</label>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="file" id="files" name="files" class="form-control" required>
                                            </div>
                                            <small class="text-warning">Upload file.</small>
                                        </div>


                                    </div>

                                    <button class="btn btn-lg bg-cyan waves-effect" name="submitFiles" type="submit">SUBMIT</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php require_once('footer.php') ?>

</section>
<!-- Chart Plugins Js -->
<script src="../plugins/chartjs/Chart.bundle.js"></script>
<!-- Custom Js -->
<script src="../js/admin.js"></script>
<script src="../js/pages/charts/chartjs.js"></script>
<!-- Jquery Core Js -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap Core Js -->
<script src="../plugins/bootstrap/js/bootstrap.js"></script>
<!-- Waves Effect Plugin Js -->
<script src="../plugins/node-waves/waves.js"></script>
<!-- Select Plugin Js -->
<script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>
<!-- Validation Plugin Js -->
<script src="../plugins/jquery-validation/jquery.validate.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Custom Js -->
<script src="../js/admin.js"></script>
<script src="../js/pages/examples/sign-up.js"></script>
</body>
</html>
