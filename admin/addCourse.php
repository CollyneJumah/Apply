<?php
/**
 * Created by PhpStorm.
 * User: CollyneJumah
 * Date: 01/09/2019
 * Time: 08:40
 */
$category=$department=$courseName='';
session_start();
if(strlen($_SESSION['user'] || strlen($_SESSION['role']))==0)
{
    echo '<script>window.location="sign-in.php"</script>';
}


?>

<!---=============================Register user data and save to db================-->
<?php

$title=$message=$category=$profile=$msg='';
require_once('connection.php');
require_once ('links.php');

if(isset($_POST['submitPost'])) {
    $category= mysqli_real_escape_string($conn, $_POST['category']);
    $faculty = mysqli_real_escape_string($conn, $_POST['faculty']);
    $courseName= mysqli_real_escape_string($conn, $_POST['course_name']);


//    select if same course has been registered
//    $categoryPost=mysqli_real_escape_string($conn,$_POST['category']);
//    $sql = "SELECT * FROM knp_courses";
//    $results = mysqli_query($conn, $sql);
//    $checkUser = mysqli_num_rows($results);
//    while ($ro=mysqli_fetch_array($results)){
//        $cate=$ro['category'];
//        $fac=$ro['faculty'];
//        $courseNam=$ro['course_name'];
//    }



    if($category=='Higher Diploma Level'){
        $course_id=1;
    }elseif ($category=='Diploma Level'){
        $course_id=2;
    }elseif ($category=='Certificate Courses'){
        $course_id=3;
    }elseif ($category=='Artisan Courses'){
        $course_id=4;
    }elseif ($category=='Competency Based Courses'){
        $course_id=5;
    }else{
        $msg='<div class="alert alert-warning fade in"><a href="#" class="close" data-dismiss="alert">&times;</a>
                   <strong>Warning!</strong>Unrecognized category. No such category in our records.Please try selecting existing category <strong><em>'.$category.'</em></strong>
                </div>';
    }

    $sql = "INSERT INTO knp_courses(category,faculty,course_name,course_id)VALUES('$category','$faculty','$courseName','$course_id')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
            $msg = '<div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert">&times;</a>
                   <strong>Success!</strong>New course added in . <strong><em>'.$category.'</em></strong>
                   course name:<strong> '.$courseName.'</strong>
                </div>';

            // echo "<script> setTimeout(function () {
            //              window.location.href= 'addCourse.php'; // the redirect goes here
            //              },9000);</script>";

    } else {
        $msg = "<div class='alert alert-danger fade in'><a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>Error!</div>".mysqli_error($conn);
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
            <h2>Add new Courses</h2>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <i class="material-icons"></i>
                        <h2>New Courses</h2>
                    </div>
                    <div class="body">
                        <div class="card card-panel">
                            <div class="body">
                                <form id="sign_in" method="POST" action="addCourse.php" enctype="multipart/form-data" autocomplete="off">
                                    <span><?php echo $msg?></span>
                                    <div class="col-sm-12">
                                        <div class="form-group form-float">
                                            <div class="col-sm-12">
                                                <span>Select Course Level :</span>
                                                <?php
                                                require_once ('connection.php');
                                                $sql='SELECT * FROM knp_studylevel ORDER BY Id ASC ';
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
                                                <span>Select Faculty:</span>
                                                <?php
                                                require_once ('connection.php');
                                                $sql='SELECT * FROM knp_faculty ORDER BY Id ASC ';
                                                $results=mysqli_query($conn,$sql);
                                                ?>
                                                <select class="form-control show-tick" name="faculty" id="faculty" required>
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
                                                <input type="text" id="course_name" name="course_name" class="form-control" required>
                                                <label for="course_name" class="form-label">Enter course name </label>
                                            </div>
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


