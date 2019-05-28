﻿<?php
@session_start();
$username=$passsword=$email=$phone=$emailErr=$Cmembership=$msg='';
require_once('connection.php');

if(isset($_POST['submitAccount'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $rand = rand(555555, 999999);
    $passHash = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));

    require '../phpMailer/PHPMailerAutoload.php';
    require '../phpMailer/class.phpmailer.php';

    $sql = "INSERT INTO knp_account(username,email,phone,password,random_password)VALUES('$username','$email','$phone','$passHash','$rand')";
    $result = mysqli_query($conn, $sql);
    if ($result==true) {
//==================================send email verification code to user for validity of email ===========================================
        $em = new PHPMailer(true);
        $em->addAddress($email);
        $em->isHTML(true);
        $em->From = 'admin@ksuca.co.ke';
        $em->Subject = '<div>EMAIL VERIFICATION</div>';
        $em->Body = '<div class="panel panel-primary"><div class="panel-heading text-center">VERIFY THAT ITS YOU!</div>

                            <div class="panel-body">
                            <p4>Dear ' . $username . ' ,Thank you for creating an account with <b>Kisii antional Polytechnic.</b> We are glad to have you. Kindly Confirm by entering the 6-digit verification code below.</p4>
                            <h3><strong>' . $rand . '</strong></h3>
                           Thank you!
                            </div>
                    </div>';
        if ($em->Send()) {
            $msg = '<div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert">&times;</a>
                   <strong>Success!</strong> Your Data has been sent successfully. Check your email to confirm the 6-digit verification code.
                </div>';
            echo "<script> setTimeout(function () {
                         window.location.href= 'verify.php'; // the redirect goes here
                         },5000);</script>";
        } else {
            $msg = '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a>
                   <strong>Error!</strong>Something went wrong.Please try again.
                   </b>
                </div>' . $em->ErrorInfo;
        }

        $_SESSION['user']=$email;
    } else {
        $msg = "<div class='alert alert-danger fade in'><a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>Error while creating account.Please try again!</div>";
    }
}

?>
<!DOCTYPE html>
<html>

<?php require_once('links.php') ?>
<body  class="login-page" style="background: white">
<div class="login-box">
    <div class="logo">
        <img src="../image/knp.jpg" class="img-responsive center-block" width="150" height="150" >

    </div>
    <div class="card">
        <div class="body">
            <form id="sign_up" method="POST" action="sign-up.php">
                <div class="msg">Register Admin</div>
                <span><?php echo $msg ?></span>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                    <div class="form-line">
                        <input type="text" class="form-control" name="username" placeholder="Enter username" required autofocus>
                    </div>
                </div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                    <div class="form-line">
                        <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                    </div>
                    <small class="text-muted text-warning">Enter correct email address currently in use. Account activation code will be send to your email.</small>
                </div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">phone_android</i>
                        </span>
                    <div class="form-line">
                        <input type="tel" class="form-control" name="phone" id="phone" onclick="show()" placeholder="+2547" maxlength="13" minlength="13" title="begin with +2547,MUST be 13 length" required>
                    </div>
                </div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                    <div class="form-line">
                        <input type="password" class="form-control" name="password" minlength="6" placeholder="Password" required>
                    </div>
                </div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                    <div class="form-line">
                        <input type="password" class="form-control" name="confirm" minlength="6" placeholder="Confirm Password" required>
                    </div>
                </div>
                <div class="form-group">
                    <input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink">
                    <label for="terms">I read and agree to the <a href="javascript:void(0);">terms of usage</a>.</label>
                </div>

                <button class="btn btn-block btn-lg bg-blue waves-effect" name="submitAccount" type="submit">SIGN UP</button>

                <div class="m-t-25 m-b--5 align-center">
                    <a href="sign-in.php">You already have a membership?</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function show() {
        document.getElementById('phone').value='+2547';
    }
</script>
<!-- Jquery Core Js -->
<script src="../plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="../plugins/bootstrap/js/bootstrap.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="../plugins/node-waves/waves.js"></script>

<!-- Validation Plugin Js -->
<script src="../plugins/jquery-validation/jquery.validate.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Custom Js -->
<script src="../js/admin.js"></script>
<script src="../js/pages/examples/sign-up.js"></script>
</body>

</html>