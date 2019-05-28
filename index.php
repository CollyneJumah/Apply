<?php
@session_start();

if(strlen($_SESSION['faculty'])==0)
{
    echo '<script>window.location="apply.php"</script>';
}

//if(strlen($_SESSION['category'])==0)
//{
//    echo '<script>window.location="apply.php"</script>';
//}


require_once 'connection.php';
$output='';
$faculty=$_SESSION['faculty'];
$category=$_SESSION['category'];
$sql="SELECT * FROM knp_courses WHERE faculty LIKE '%".$faculty."%' and category LIKE '%".$category."%'";

$results=mysqli_query($conn,$sql);
while ($row=mysqli_fetch_assoc($results)) {
    $output .= '<option>' . $faculty = $row["course_name"] . '</option>';
}
$msg='';
require_once ('connection.php');

if(isset($_POST['submitData'])) {

    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $surname = mysqli_real_escape_string($conn, $_POST['surname']);
    $otherName = mysqli_real_escape_string($conn, $_POST['otherName']);
    $identity = mysqli_real_escape_string($conn, $_POST['identity']);
    $birth = mysqli_real_escape_string($conn, $_POST['birth']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $county= mysqli_real_escape_string($conn, $_POST['county']);
    $primary = mysqli_real_escape_string($conn, $_POST['pri_school']);
    $priIndex = mysqli_real_escape_string($conn, $_POST['priIndex']);
    $dateTo_pri = mysqli_real_escape_string($conn, $_POST['dateTo_pri_school']);
    $marks = mysqli_real_escape_string($conn, $_POST['marks']);
    $secondary = mysqli_real_escape_string($conn, $_POST['sec_school']);
    $secIndex = mysqli_real_escape_string($conn, $_POST['secIndex']);
    $dateTo_sec = mysqli_real_escape_string($conn, $_POST['dateTo_sec_school']);
    $grade = mysqli_real_escape_string($conn, $_POST['grade']);
    $studyMode = mysqli_real_escape_string($conn, $_POST['studyMode']);
    $feeSource = mysqli_real_escape_string($conn, $_POST['feeSource']);




//    check for id,phone,and email existence

    $sqlEmail = "SELECT * FROM `knp_data` WHERE `email`='" . $email . "'";
    $sqlId = "SELECT * FROM `knp_data` WHERE `identity`='" . $identity . "'";
    $sqlPhone = "SELECT * FROM `knp_data` WHERE `phone`='" . $phone . "'";


    $resultsEmail = mysqli_query($conn, $sqlEmail);
    $resultsId = mysqli_query($conn, $sqlId);
    $resultsPhone = mysqli_query($conn, $sqlPhone);

    $checkPhone = mysqli_num_rows($resultsPhone);
    $checkEmail = mysqli_num_rows($resultsEmail);
    $checkId = mysqli_num_rows($resultsId);

    if ($checkEmail > 0) {
        $msg = '<div class="alert alert-warning fade in">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Warning!</strong> Similar email address exist.Please try a different <a href="#" class="alert-link">email address.</a>If the problem persist contact system administrator..
    </div>';
    }
    if ($checkPhone != 0) {
        $msg = '<div class="alert alert-warning fade in">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Warning!</strong> Similar Phone number exist.Please try using different<a href="#" class="alert-link">Phone number.</a>If the problem persist contact system administrator.
    </div>';
    }
    if ($checkId != 0) {
        $msg = '<div class="alert alert-warning fade in">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Warning!</strong> Similar Identification exist.Please try using different<a href="#" class="alert-link">Id/Passport Number or Birth certificate.</a>If the problem persist contact system administrator.
    </div>';
    } else {

        $sql = "INSERT INTO `knp_data`(`category`,`course`, `surname`, `otherName`, `identity`, `birth`, `phone`, `email`, `gender`, `address`, `county`, `pri_school`, `priIndex`, `dateTo_pri_school`, `marks`, `sec_school`, `secIndex`, `dateTo_sec_school`, `grade`, `studyMode`, `feeSource`) VALUES('$category','$course','$surname','$otherName','$identity','$birth','$phone','$email','$gender','$address','$county','$primary','$priIndex','$dateTo_pri','$marks','$secondary','$secIndex','$dateTo_sec','$grade','$studyMode','$feeSource')";
        $result = mysqli_query($conn, $sql);
        if ($result) {

            $to_mail="$email";
            $subject="KISIIPOLY COURSE APPLICATION";
            $message="Thank you for Applying a course with Kisiipoly";
            $headers="From: collynejumah2010@gmail.com";
            mail($to_mail,$subject,$message,$headers);

            $msg = '<div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert">&times;</a>
                   <strong>Success!</strong> Your Data has been sent successfully.
</div>';
        } else {
            $msg = '<div class="alert alert-danger fade in col-md-4 col-md-offset-4">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Error!</strong> A problem has occurred while submitting your data.Please try again
</div>' . mysqli_error($conn);
        }
    }
}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="image/knp.jpg" rel="icon">

    <title>Online course application System</title>

<!--    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
<!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>-->
<!--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>-->

<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->
    <link href="bootstrap/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="bootstrap/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <style>
        #msg{
            display: none;}
        .box{
            width: 800px;margin: 0 auto;
        }
        .active_tab1{
            background-color: #fff;
            color: #333;
            font-weight: 600;
        }
        .inactive_tab1{
            background-color: #f5f5f5;
            color: #333;
            cursor: not-allowed;
        }
        .has_error{
            border-color: #cc0000;
            background-color: #ffff99;
        }
        .no-gutters {
            margin-right: 0;
            margin-left: 0;

        > .col,
        > [class*="col-"] {
            padding-right: 0;
            padding-left: 0;
        }
        }
    </style>

</head>
<body>
<div class="panel pan text-center bg-success tab-pane">

<img src="image/knp.jpg" class="img-circle img-responsive center-block" alt="CatholicAction" width="100px" height="100px">
    <h4>Kisii National polytechnic</h4>
    <h5>Website: <a href="https://www.kisiipoly.ac.ke" target="_blank" >www.kisiipoly.ac.ke</a><br>
        info@kisiipoly.ac.ke
    </h5>


</div>
    <div class="container-fluid">
        <div class="row no-gutters">
            <div class="col-lg-12">
                <div class="panel panel-heading text-center" style="background: #2d8237;color: #fff;"><h3>Online Course Application</h3></div>
                <div class="panel panel-success">
                    <form method="post" action="index.php" name="apply" onsubmit="return validate();" autocomplete="off" enctype="multipart/form-data">
                        <div class="panel-heading text-center">
                            <h5 class="text-warning">Select your Course you had applied for*</h5>
                            <span><?php echo $msg?></span>
                            <span id="msg" class="alert-success">Success</span>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="col-md-4 col-md-offset-4">
                                    <label for="course">Course*:</label>
                                    <select id="course" name="course" class="form-control" required>
                                        <option value="">--Select Course--</option>
                                        <?php echo $output?>
                                    </select>
                                    <span id="courseErr"></span><br>
                                </div>

                                <br>
                            </div>
                        </div>
                        <br>


                        <div class="panel panel-success">
                            <div class="panel panel-success" style="border-radius: 10px 0 70px 70px;background-color: #2d8237;color: white;text-align: center;">
                                <h5>Personal Data</h5>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12">
                                       <div class="card">
                                           <div class="card-body">
                                               <div class="col-md-4">
                                                   <label for="surname">Surname*:</label>
                                                   <input type="text" class="form-control" id="surname" name="surname">
                                                   <span id="surnameErr"></span>
                                                   <label for="otherName">Other name*:</label>
                                                   <input type="text" class="form-control" id="otherName" name="otherName">
                                                   <span id="otherNameErr"></span>
                                                   <label for="phone">Mobile/Cell*:</label>
                                                   <input type="text" class="form-control" onclick="set();" id="phone" name="phone">
                                                   <span id="phoneErr"></span>
                                                   <br>
                                               </div>

                                           </div>
                                       </div>
                                        <div class="col-md-4">
                                            <label for="address">Contact Address*:</label>
                                            <input type="text" name="address" class="form-control" id="address">
                                            <span id="addressErr"></span>

                                            <label for="birth">Date of birth*:</label>
                                            <input type="date" class="form-control" id="birth" name="birth">
                                            <span id="birthErr"></span>
                                            <br>
                                            <div class="form-group custom-control custom-radio">
                                                <label for="gender">Gender:</label><br>
                                                <label class="radio-inline">
                                                    <input type="radio" class="custom-control-input" name="gender" id="gender id" value="Male" checked autofocus>Male
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="gender" id="gender id" value="Female" autofocus>Female
                                                </label>
                                                <span></span>
                                            </div>
<!---->

                                        </div>
                                        <div class="col-md-4">
                                            <label for="identity">Passport/National Id/Birth Certificate*:</label>
                                            <input type="text" class="form-control" id="identity" name="identity">
                                            <span id="identityErr"></span>
                                            <label for="email">Email Address*:</label>
                                            <input type="email" class="form-control" id="email" name="email">
                                            <span id="emailErr"></span>
                                            <div class="form-group">
                                                <label for="religion">County:</label>
                                                <?php
                                                require_once ('connection.php');
                                                $sql='SELECT * FROM county ORDER BY Id ASC ';
                                                $results=mysqli_query($conn,$sql);
                                                ?>
                                                <select class="form-control" id="county" name="county" required>
                                                    <option value="">--Select county</option>
                                                    <?php while ($row=mysqli_fetch_array($results)):;?>
                                                        <option  value="<?php echo $row[1];?>"><?php echo $row[1];?></option>
                                                    <?php endwhile;?>
                                                </select>
                                                <span id="countyErr"></span>
                                            </div>

                                            <br>
                                        </div>
                                    </div>
                                </div>
                                <!--======================================Academic Qualification=====================================-->
                                <div class="panel panel-success">
                                    <div class="panel panel-success" style="border-radius: 10px 0 70px 70px;background-color: #2d8237;color: white;text-align: center;">
                                        <h5>Academic Qualification</h5>
                                    </div>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="col-md-3">
                                                    <label for="pri_school">Primary School*:</label>
                                                    <input type="text" class="form-control" name="pri_school" id="pri_school">
                                                    <span id="pri_schoolErr"></span>

                                                    <?php $years = range(2000, strftime("%Y", time())); ?>
                                                    <label for="dateTo_pri_school">Year of completion(Primary)*:</label>
                                                    <select class="form-control" name="dateTo_pri_school" id="dateTo_pri_school">
                                                        <option value="">--Select--year</option>
                                                        <?php foreach($years as $year) : ?>
                                                            <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <span id="dateTo_pri_schoolErr"></span>

                                                </div>
                                                <div class="col-md-3">
                                                    <label for="marks">Index Number(KCPE)*:</label>
                                                    <input type="number" class="form-control" id="priIndex" name="priIndex">
                                                    <span id="priIndex"></span>
                                                    <span id="priIndexErr"></span>
                                                    <label for="marks">Marks(KCPE)*:</label>
                                                    <input type="number" class="form-control" id="marks" name="marks">
                                                    <span id="marksErr"></span><br>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="sec_school">Secondary School*:</label>
                                                    <input type="text" class="form-control" name="sec_school" id="sec_school">
                                                    <span id="sec_schoolErr"></span>
                                                    <label for="dateTo_pri_school">Year of completion(Secondary.)*:</label>
                                                    <select class="form-control" name="dateTo_sec_school" id="dateTo_sec_school">
                                                        <option value="">--Select--year</option>
                                                        <?php foreach($years as $year) : ?>
                                                            <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <span id="secYearErr"></span>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="secIndex">Index Number(KCSE)*:</label>
                                                    <input type="number" class="form-control" id="secIndex" name="secIndex">
                                                    <span id="secIndexErr"></span>

                                                    <label for="grade">Grade(KCSE)*:</label>
                                                    <select name="grade" id="grade" class="form-control">
                                                        <option>--Select Grade--</option>
                                                        <option>A(Plain)</option>
                                                        <option>A(Minus)</option>
                                                        <option>B(Plus)</option>
                                                        <option>B(Plain)</option>
                                                        <option>B(Minus)</option>
                                                        <option>C(Plus)</option>
                                                        <option>C(Plain)</option>
                                                        <option>C(Minus)</option>
                                                        <option>D(Plus)</option>
                                                        <option>D(Plain)</option>
                                                        <option>D(Minus)</option>
                                                        <option>E</option>
                                                    </select>
                                                    <span id="gradeErr"></span><br>
                                                </div>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <div class="panel panel-success">
                                <div class="panel panel-success" style="border-radius: 10px 0 70px 70px;background-color: #2d8237;color: white;text-align: center;">
                                    <h5>Mode of Study and Other Details</h5>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="col-md-4 col-md-offset-4">
                                            <label for="studyMode">Mode of Study*:</label>
                                            <select id="studyMode" class="form-control" name="studyMode" required>
                                                <option>--Select Mode--</option>
                                                <option>Full</option>
                                                <option>Part Time</option>
                                            </select>
                                            <span id="studyModeErr"></span><br>
                                            <label for="feeSource">Source of School fees:</label>
                                            <select id="feeSource" class="form-control" name="feeSource" required>
                                                <option>--Select Source--</option>
                                                <option>Self</option>
                                                <option>Sponsored</option>
                                            </select>
                                            <span id="feeSourceErr"></span><br>
                                        </div>

                                        <br>
                                    </div>
                                </div>
                                <div class="panel pane text-center">
                                    <h4 class="text-warning">Applicant Declaration</h4>
                                    <p>

                                        I hereby certify that the information given in this Application Form is correct and complete to the best of my knowledge and hereby give my permission to the Registrar (AA) to obtain any verification deemed necessary to process my application. I will include with this application my application fee and other documents as required in the application instructions.
                                    </p>
                                    <input type="submit" id="btn" name="submitData" value="submit application" class="btn btn-primary" style="background: #2d8237">
                                
                                    <a href="decline.php" ><button type="button" class="btn btn-warning pull-right">Back</button></a>

                                </div>
                            </div>
                        </div>

                    </form>

                <p class="panel-footer text-center">copyright © 2019 Kisii Nationa Polytechnic. All rights reserved.
                    <i class="fa fa-envelope" style="color: #5592ff"><a href="mailto:kisiipolytechnic@gmail.com" target="_blank" style="color: #5592ff">kisiipolytechnic@gmail.com</a> </i><br>

                </p>
                </div>

            </div>
        </div>

        </div>

<script src="bootstrap/jquery/jquery.js"></script>
<script src="bootstrap/bootstrap/js/bootstrap.js"></script>
</body>
</html>


<script type="text/javascript" src="validate.js">
    $('#btn').click(function () {
        $('#msg').fadeIn(300).delay(1500).fadeOut(400);
    })
</script>
