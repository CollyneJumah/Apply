<?php
/**
 * Created by PhpStorm.
 * User: CollyneJumah
 * Date: 01/11/2019
 * Time: 09:53
 */

@session_start();
include('connection.php');
require_once ('links.php');
$id='';
if(strlen($_SESSION['user'])==0)
{
    header('location:login.php');
}
else{
    date_default_timezone_set('Asia/Kolkata');// change according timezone
    $currentTime = date( 'd-m-Y h:i:s A', time () );

    if(isset($_POST['submitUpdate'])) {

        $name = $_POST['fname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $gender= $_POST['gender'];
        $depart = $_POST['department'];
        $course = $_POST['course'];
        $id = intval($_GET['id']);
        $sql =mysqli_query($conn,"update noticeboard_members set fname='$name',phone='$phone',email='$email',gender='$gender',department='$depart',course='$course' where id='$id'");
        $_SESSION['msg'] = "Member data updated. Redirecting back please wait.....".mysqli_error($conn);
        echo "<script> setTimeout(function () {
             window.location.href= 'users.php'; // the redirect goes here
             },7000);</script>";

    }

    ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/html">
    <head>
        <!-- Bootstrap Select Css -->
        <link href="../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
        <style>
            ul{
                list-style-type: none;
                font-family: Cambria;
            }
            h4{
                font-family: Cambria;
            }

        </style>
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

    <?php

    require_once ('topNav.php');
    require_once ('sidebar.php')
    ?>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Display Information</h2>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <i class="material-icons"></i>
                            <h2>Applicant Information</h2>
                                                        <a href="print.php" target="_blank"><button type="submit" class="btn btn-warning" ><i class="material-icons">print</i> </button> </a>

                        </div>
                                <div class="panel-body">

                                        <div class="body">

                                            <?php
                                            $id=intval($_GET['id']);
                                            $query=mysqli_query($conn,"select * from knp_data where id='$id'");
                                            while($row=mysqli_fetch_array($query))
                                            {

                                                $surname=$row['surname'];
                                                $name=$row['otherName'];
                                                $fname=$surname.' '.$name;
                                                $level=$row['category'];
                                                $course=$row['course'];
                                                $id=$row['id'];
                                                $gender=$row['gender'];
                                                $status=$row['status'];
                                                $email=$row['email'];
                                                $phone=$row['phone'];
                                                $birth=$row['birth'];
                                                $identity=$row['identity'];
                                                $address=$row['address'];
                                                $priSch=$row['pri_school'];
                                                $dateToPri=$row['dateTo_pri_school'];
                                                $marks=$row['marks'];
                                                $priIndex=$row['priIndex'];
                                                $secIndex=$row['secIndex'];
                                                $county=$row['county'];
                                                $sec=$row['sec_school'];
                                                $dateToSec=$row['dateTo_sec_school'];
                                                $grade=$row['grade'];
                                                $studyMode=$row['studyMode'];
                                                $feeSource=$row['feeSource'];
                                                $status=$row['status'];
                                                $time=$row['time'];

                                                if($status==1){
                                                    $status="Approved";
                                                }else{
                                                    $status="Not approved";
                                                }
                                                ?>

                                            <?php } ?>
                                            <div class="col-lg-12">
                                                <div class="col-lg-4">
                                                   <div class="panel panel-success">
                                                       <div class="panel-heading" style="background-color: green;color: white">
                                                           <h4>Personal information</h4>
                                                       </div>
                                                       <div class="panel-body">
                                                           <ul style="list-style-type: none;padding-left: 0">
                                                               <li><b>Full Name: </b><?php echo $fname?></li>
                                                               <li><b>Gender: </b><?php echo $gender?></li>
                                                               <li><b>Phone: </b><?php echo $phone?>
                                                               <li><b>Email: </b><?php echo $email?></li>
                                                               <li><b>Address: </b><?php echo $address?></li>
                                                               <li><b>Identity: </b><?php echo $identity?></li>
                                                               <li><b>Religion: </b><?php echo $county?></li>
                                                               <li><b>Date of Birth: </b><?php echo $birth?></li>
                                                           </ul>
                                                       </div>
                                                   </div>

                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="panel panel-success">
                                                        <div class="panel-heading" style="background-color: green;color: white">
                                                            <h4>Education Background</h4>
                                                        </div>
                                                        <div class="panel-body">
                                                            <ul style="list-style-type: none;padding-left: 0">
                                                                <li><b>Primary School: </b><?php echo $priSch?></li>
                                                                <li><b>Index Number: </b><?php echo $priIndex?></li>
                                                                <li><b>Date of Completion(KCPE): </b><?php echo $dateToPri?>
                                                                <li><b>Marks Scored: </b><?php echo $marks?></li>
                                                                <li><b>Secondary School: </b><?php echo $sec?></li>
                                                                <li><b>Index Number: </b><?php echo $secIndex?></li>
                                                                <li><b>Date Finished(KCSE year): </b><?php echo $dateToSec?></li>
                                                                <li><b>Grade: </b><?php echo $grade?></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="panel panel-success">
                                                        <div class="panel-heading" style="background-color: green;color: white">
                                                            <h4>Other Information</h4>
                                                        </div>
                                                        <div class="panel-body">
                                                            <ul style="list-style-type: none;padding-left: 0">
                                                                <li><b>Level of Study applying for: </b></li><?php echo $level?>
                                                                <li><b>Course Applying: </b></li><?php echo $course?>
                                                                <li><b>Mode of Study: </b></li><?php echo $studyMode?>
                                                                <li><b>Source of School Fees: </b></li><?php echo $feeSource?>
                                                                <li><b>Status:</b></li><?php echo $status?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>




                                        </div>
                                    </div>



                                </div>
                    </div>
                </div>
            </div>


            <?php require_once('footer.php') ?>
    </section>













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
<?php } ?>