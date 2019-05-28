<?php
/**
 * Created by PhpStorm.
 * User: CollyneJumah
 * Date: 01/09/2019
 * Time: 08:40
 */
$category=$department='';
session_start();
if(strlen($_SESSION['user'] || strlen($_SESSION['role']))==0)
{
    echo '<script>window.location="sign-in.php"</script>';
}


?>

<!---=============================Register user data and save to db================-->
<?php

$title=$message=$profile=$msg='';
require_once('connection.php');
require_once ('links.php');
require '../phpMailer/PHPMailerAutoload.php';
require '../phpMailer/class.phpmailer.php';


if(isset($_POST['submitPost'])) {

    $categoryPost=mysqli_real_escape_string($conn,$_POST['category']);
    $sql = "SELECT * FROM noticeboard_subscription WHERE category='$categoryPost' ";
    $results = mysqli_query($conn, $sql);
    $checkUser = mysqli_num_rows($results);
    while ($ro=mysqli_fetch_array($results)){
        $studentId=$ro['student_id'];
        $username=$ro['name'];
        $email=$ro['email'];
        $phone=$ro['phone'];
        $category=$ro['category'];
        $department=$ro['department'];
    }

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);


    $profile=$_FILES['files']['name'];
    $fileTemp=$_FILES['files']['tmp_name'];
    $path="../postFiles/".basename($profile);
    $file_extension = pathinfo($profile, PATHINFO_EXTENSION);
//    $allowed_image_ext=array("jpg","jpeg","png","gif");

    $sql = "INSERT INTO noticeboard_posts(title,message,files,category,department,student_id,email)VALUES('$title','$message','$profile','$category','$department','$studentId','$email')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        move_uploaded_file($fileTemp,$path);
//       ============send email to subscribed users
        $em = new PHPMailer(true);
        $em->addAddress($email);
        $em->isHTML(true);
        $em->From = 'admin@ksuca.co.ke';
        $em->Subject = '<div>NEW POST FROM CHUKA UNIVERSITY:</div>';
        $em->Body = '<div class="panel panel-primary"><div class="panel-heading text-center">Hi! '.$username.' you have a new post. </div>

                            <div class="panel-body">
                            <p4>Please click the link below to view post from '.$department.' department.</p4>
                            <a href="http://noticeboard.ksuca.co.ke/users/viewPosts.php" target="_blank">Check your new post</a>
                            
                      
                           Thank you!
                            </div>
                    </div>';
        if ($em->Send()) {

            $msg = '<div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert">&times;</a>
                   <strong>Success!</strong>POST send to email subscribers of category. <strong><em>'.$category.'</em></strong>
                </div>';

            echo "<script> setTimeout(function () {
                         window.location.href= 'posts.php'; // the redirect goes here
                         },9000);</script>";
        } else {
            $msg = '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a>
                   <strong>Error!</strong>Something went wrong.Please try again.
                   </b>
                </div>' . $em->ErrorInfo;
        }




    } else {
        $msg = "<div class='alert alert-danger fade in'><a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>Error while sending posts!</div>".mysqli_error($conn);
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
            <h2>Add post</h2>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <i class="material-icons"></i>
                        <h2>Add Posts</h2>
                    </div>
                    <div class="body">
                        <div class="card card-panel">
                            <div class="body">
                                <form id="sign_in" method="POST" action="posts.php" enctype="multipart/form-data" autocomplete="off">
                                    <span><?php echo $msg?></span>
                                    <div class="col-sm-12">
                                        <div class="form-group form-float">
                                            <div class="col-sm-12">
                                                <span>Select Post Category:</span>
                                                <?php
                                                require_once ('connection.php');
                                                $sql='SELECT * FROM noticeboard_categories ORDER BY Id ASC ';
                                                $results=mysqli_query($conn,$sql);
                                                ?>
                                                <select class="form-control show-tick" name="category" id="category" required>
                                                    <?php while ($row=mysqli_fetch_array($results)):;?>
                                                        <option  value="<?php echo $row[1];?>"><?php echo $row[1];?></option>
                                                    <?php endwhile;?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group form-float">
                                            <div class="col-sm-12">
                                                <span>Select Department:</span>
                                                <?php
                                                require_once ('connection.php');
                                                $sql='SELECT * FROM noticeboard_departments ORDER BY Id ASC ';
                                                $results=mysqli_query($conn,$sql);
                                                ?>
                                                <select class="form-control show-tick" name="department" id="department" required>
                                                    <?php while ($row=mysqli_fetch_array($results)):;?>
                                                        <option  value="<?php echo $row[1];?>"><?php echo $row[1];?></option>
                                                    <?php endwhile;?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="title" name="title" class="form-control" required>
                                                <label for="title" class="form-label">Post Title</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <textarea type="text" id="message" cols="5" rows="4" name="message"  class="form-control" required></textarea>
                                                <label for="message" class="form-label">Message</label>

                                            </div>
                                            <small class="text-warning">Add post here</small>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="file" id="files" name="files" class="form-control">
                                            </div>
                                            <small class="text-warning">Upload file or picture to your post.</small>
                                        </div>


                                    </div>

                                    <button class="btn btn-lg bg-cyan waves-effect" name="submitPost" type="submit">SUBMIT</button>
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


