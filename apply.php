<?php
/**
 * Created by PhpStorm.
 * User: CollyneJumah
 * Date: 01/07/2019
 * Time: 08:35
 */
@session_start();

require_once 'connection.php';

$category=$faculty=$msg=$output='';

if(isset($_POST['submit'])){
    $category=mysqli_real_escape_string($conn,$_POST['category']);
    $faculty=mysqli_real_escape_string($conn,$_POST['faculty']);

//    check if similar course name exist in the courses table
    $sql="SELECT * FROM knp_courses WHERE category LIKE '%".$category."%' and faculty LIKE '%".$faculty."%'";
    $results=mysqli_query($conn,$sql);
    $check=mysqli_num_rows($results);
    if($check ==0){
        $msg='<div class="alert alert-warning alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>No match!</strong>The selected Study level and the department contain no related course.Either the course is not being oferred  by the institution or has not yet been introduced.
    </div>';
        echo "<script> setTimeout(function () {
                         window.location.href= 'apply.php';
                         },10000);</script>";
    }else {
//else if its found check the selected category

        $sql = "INSERT INTO knp_dummy_course(category,faculty)VALUES ('$category','$faculty')";

        $results = mysqli_query($conn, $sql);
        if ($results) {
            $msg = '<div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Redirecting!</strong>Please wait..... 
</div>';
            $_SESSION['faculty'] = $faculty;
            $_SESSION['category'] = $category;
            echo "<script> setTimeout(function () {
                         window.location.href= 'index.php';
                         },5000);</script>";

        } else {
            $msg = '<div class="alert alert-danger alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error occurred!</strong>Please try again. If the problem persist, contact system administrator.
</div>' . mysqli_error($conn);
            echo "<script> setTimeout(function () {
                         window.location.href= 'apply.php';
                         },5000);</script>";
        }


    }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Course application">
    <link rel="icon" href="image/knp.jpg" type="image/ico" />
    <meta name="author" content="CA EDITORIAL BOARD">

    <title>Course Application</title>


    <link href="bootstrap/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="bootstrap/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<style>
    .text-on-pannel {
        background: #fff none repeat scroll 0 0;
        height: auto;
        margin:0 0 80px 80px;
        padding: 3px 5px;
        position: absolute;
        margin-top: -47px;
        border: 1px solid #337a07;
        border-radius: 8px;
    }

    .panel {
        /* for text on pannel */
        margin-top: 27px !important;
    }

    .panel-body {
        padding-top: 30px !important;
    }
    .head{border-radius: 0 0 70px 70px}
</style>
</head>

<body>
<div class="panel pan text-center bg-primary tab-pane">
    <div class="panel-default head" style="background: #2d8237;">
        <div class="panel-heading" style="background: #fff;">
            <img src="image/knp.jpg" class="img-responsive center-block" alt="KNP Logo" width="100px" height="100px">
            <h4>Kisii National polytechnic</h4>
            <h5>Website: <a href="https://www.kisiipoly.ac.ke" target="_blank" >www.kisiipoly.ac.ke</a><br>
                info@kisiipoly.ac.ke
            </h5>
        </div>
        <div class="panel-body">
            <h5>Select Level Of Study and the department you are applying for.</h5>
        </div>
    </div>
</div>
            <div class="container">
                <div class="panel panel-default">
                    <span class="col-md-4 col-md-offset-4"><?php echo $msg ?></span>
                    <div class="panel-body">
                       <div class="col-md-4 col-md-offset-4">
                           <form role="form" method="post" action="apply.php" autocomplete="off" enctype="multipart/form-data">
                               <fieldset style="color: #2d8237">
                                   <div class="form-group">
                                       <?php
                                       require_once ('connection.php');
                                       $sql='SELECT * FROM knp_studylevel ORDER BY Id ASC ';
                                       $results=mysqli_query($conn,$sql);
                                       ?>
                                       <label for="level">Study Level:</label>
                                       <select class="form-control" id="category" name="category" required>
                                           <option value="">--Select level of study</option>

                                           <?php while ($row=mysqli_fetch_array($results)):;?>
                                               <option  value="<?php echo $row[1];?>"><?php echo $row[1];?></option>
                                           <?php endwhile;?>
                                       </select>
                                   </div>
                                   <div class="form-group">
                                       <?php
                                       require_once ('connection.php');
                                       $sql='SELECT * FROM knp_faculty ORDER BY Id ASC ';
                                       $results=mysqli_query($conn,$sql);
                                       ?>
                                       <label for="level">Department:</label>
                                       <select class="form-control" id="faculty" name="faculty" required>
                                           <option value="">--Select Academic Department--</option>
                                           <?php while ($row=mysqli_fetch_array($results)):;?>
                                               <option  value="<?php echo $row[1];?>"><?php echo $row[1];?></option>
                                           <?php endwhile;?>
                                       </select>
                                   </div>

                                   <input type="submit" name="submit" id="submit" class="btn btn-lg btn-success" value="Next">
                               </fieldset>
                           </form>
                       </div>
                    </div>
                    <div class="panel-footer text-center" style="background: #2d8237;color: #fff">
                        <h5>Kisiipoly Online course application System</h5>
                        <h5>All rights reserved. &copy copyright2019</h5>
                    </div>
                </div>
                <div>


<script src="bootstrap/jquery/jquery.js"></script>
<script src="bootstrap/bootstrap/js/bootstrap.js"></script>

</body>

</html>
