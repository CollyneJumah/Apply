<?php
session_start();
$username=$sh=$msg=$email1=$verification_code=$photo=$phone1='';
include('connection.php');
$sh=$_SESSION['user'];

$sql1="SELECT * FROM knp_account WHERE email='".$sh."'";

$query1=mysqli_query($conn,$sql1);

while($row1=mysqli_fetch_array($query1)){
$id=$row1['id'];
$username=$row1['username'];
$phone=$row1['phone'];
$email=$row1['email'];
$verification_code=$row1['random_password'];
$status=$row1['status'];
}

if(isset($_POST['submitVerify'])){
    $code=mysqli_real_escape_string($conn,$_POST['code']);

    if($code==$verification_code){
        $msg = '<div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert">&times;</a>
                   <strong>Verifying!</strong>Please wait.....
                </div>';
        $sql1="UPDATE knp_account SET status=1 WHERE email='".$sh."'";
        $re=mysqli_query($conn,$sql1);

        echo "<script> setTimeout(function () {
                         window.location.href= 'sign-in.php'; // the redirect goes here
                         },5000);</script>";
        $msg = '<div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert">&times;</a>
                   <strong>Account activated successfully!</strong>Login to proceed
                </div>';
        echo "<script> setTimeout(function () {
                         window.location.href= 'sign-in.php'; // the redirect goes here
                         },3000);</script>";
    }else{
        $msg = '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a>
                   <strong>Error!</strong> Code do not match.Please try again.
                </div>';
        echo "<script> setTimeout(function () {
                         window.location.href= 'verify.php'; // the redirect goes here
                         },5000);</script>";
    }

}

?>

<!DOCTYPE html>
<html>
<?php require_once('links.php') ?>
<body class="fp-page" style="background-color: #337a07">
<div class="fp-box">
    <div class="logo">
        <a href="javascript:void(0);"><b>Kisii National Polytechnic</b></a>
        <small>Welcome  <?php echo $sh?></small>

    </div>
    <div class="card">
        <div class="body">
            <span><?php echo $msg ?></span>
            <form id="forgot_password" action="verify.php" method="POST">
                <div class="msg">
                        Enter verification code send to your email. We'll redirect to login page.
                </div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                    <div class="form-line">
                        <input type="number" class="form-control" name="code" placeholder="code" title="Enter 6-digit code" maxlength="6" minlength="6" required autofocus>
                    </div>
                </div>

                <button class="btn btn-lg bg-green waves-effect" name="submitVerify" type="submit">VERIFY CODE</button>

                <div class="row m-t-20 m-b--5 align-center">
                    <a href="sign-in.php">Sign In!</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Jquery Core Js -->
<script src="../plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="../plugins/bootstrap/js/bootstrap.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="../plugins/node-waves/waves.js"></script>

<!-- Validation Plugin Js -->
<script src="../plugins/jquery-validation/jquery.validate.js"></script>

<!-- Custom Js -->
<script src="../js/admin.js"></script>
<script src="../js/pages/examples/forgot-password.js"></script>
</body>

</html>
