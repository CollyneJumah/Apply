<?php
/**
 * Created by PhpStorm.
 * User: CollyneJumah
 * Date: 01/09/2019
 * Time: 08:40
 */
session_start();
if(strlen($_SESSION['user'])==0)
{
    echo '<script>window.location="sign-in.php"</script>';
}


require_once('links.php');
include('connection.php');
$sql2="SELECT * FROM noticeboard_account WHERE student_id = '" . $_SESSION['user']. "'";
$query2=mysqli_query($conn,$sql2);
while($row2=mysqli_fetch_array($query2,MYSQLI_ASSOC)){
    $id=$row2['student_id'];
    $username=$row2['username'];
    $phone1=$row2['phone'];
    $email1=$row2['email'];
}

?>

<!---=============================Register user data and save to db================-->
<?php

$username=$passsword=$email=$phone=$fname=$profile=$student_id=$department=$course=$msg='';
require_once('connection.php');

if(isset($_POST['register'])) {
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);

    $profile=$_FILES['photo']['name'];
    $fileTemp=$_FILES['photo']['tmp_name'];
    $path="../pictures/".basename($profile);
    $file_extension = pathinfo($profile, PATHINFO_EXTENSION);
    $allowed_image_ext=array("jpg","jpeg","png","gif");


    $sql = "INSERT INTO noticeboard_members(fname,student_id,phone,email,gender,department,course,photo)VALUES('$fname','$student_id','$phone','$email','$gender','$department','$course','$profile')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        move_uploaded_file($fileTemp,$path);
        $msg = '<div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert">&times;</a>
                   <strong>Success!</strong> Redirecting to profile.Please wait.......</b>
                </div>';
        echo "<script> setTimeout(function () {
             window.location.href= 'profile.php'; // the redirect goes here
             },8000);</script>";
    } else {
        $msg = "<div class='alert alert-danger fade in'><a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>Error while creating account,similar account exist Please use different credentials!</div>".mysqli_error($conn);
    }
}

?>



<!DOCTYPE html>
<html>
<head>
    <!-- Bootstrap Select Css -->
    <link href="../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
</head>

<?php require_once('links.php') ?>

<body class="panel panel-default">

    <div class="panel panel-default">
        <div class="panel-heading text-center">Dear <b class="text-info"><?php echo $id ?></b> provide us with additional information.Tell us more about yourself by filling this form?</b></div>
    </div>

    <div class="col-md-4 col-md-offset-4">
        <div class="panel-body">
            <div class="card card-panel">
                <div class="body">
                    <form id="sign_in" method="POST" action="register.php" enctype="multipart/form-data">
                            <span><?php echo $msg?></span>
                        <div class="col-sm-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="fname" name="fname" class="form-control" required>
                                    <label for="fname" class="form-label">Full name</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="student_id" name="student_id" value="<?php echo $id ?>" class="form-control" required readonly>
                                    <label for="student_id" class="form-label">Student Id</label>

                                </div>
                                <small class="text-warning">Your student Id Cannot be modified.</small>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="tel" id="phone" name="phone" value="<?php echo $phone1 ?>" class="form-control" required>
                                    <label for="phone" class="form-label">Phone</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="email" id="email" name="email" value="<?php echo $email1?>" class="form-control" required>
                                    <label for="email" class="form-label">Email</label>
                                </div>
                            </div>
                        </div>
                       <div class="col-sm-12">
                           <div class="form-group">
                               <input type="radio" name="gender" id="male" class="with-gap" required>
                               <label for="male">Male</label>

                               <input type="radio" name="gender" id="female" class="with-gap">
                               <label for="female" class="m-l-20">Female</label>
                           </div>
                       </div>
                        <div class="col-sm-12">
                            <select class="form-control show-tick" name="department" id="department" required>
                                <option value="">--Select--Department--</option>
                                <option>Business</option>
                                <option>Education</option>
                                <option>Computing</option>
                                <option>Medical</option>
                                <option>Agriculture</option>
                            </select>
                        </div>
                        <div class="col-sm-12">
                            <select class="form-control show-tick" id="course" name="course" required>
                                <option value="">--Select--Course--</option>
                                <option>Accounting</option>
                                <option>Education Arts</option>
                                <option>Computer Science</option>
                                <option>Nursing</option>
                                <option>Aquatic</option>
                            </select>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="file" id="photo" name="photo" class="form-control" required>
                                </div>
                                <small class="text-warning">Upload your profile image.</small>
                            </div>
                            
                        
                        </div>

                        <button class="btn btn-lg bg-cyan waves-effect" name="register" type="submit">SUBMIT</button>
                        <p>Already submitted data click <a href="profile.php">here</a>. For demo purposes kindly create your own <a href="sign-up.php">account</a> </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

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