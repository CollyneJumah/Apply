
<?php
@session_start();
require_once ('connection.php');
$username=$sid=$email='';
if(isset($_POST['submitForget'])){
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $sql="SELECT * FROM noticeboard_account WHERE email='$email'";
    $result=mysqli_query($conn,$sql);
    while ($row=mysqli_fetch_array($result)){
        $ran=rand(111111,999999);
        $username=$row['username'];
        $sid=$row['student_id'];
//        $email=$row['email'];
        $password=$row['password'];


    }

}
?>


<!DOCTYPE html>
<html>

<?php require_once('links.php') ?>
<body class="fp-page">
    <div class="fp-box">
        <div class="logo">
            <a href="javascript:void(0);"><b>NoticeBoard</b></a>
            <small>Welcome to Online Notification System.</small>
        </div>
        <div class="card">
            <div class="body">
                <form id="forgot_password" action="forgot-password.php" method="POST">
                    <div class="msg">
                        Enter your email address that you used to register. We'll send you an email with your username and a
                        link to reset your password.
                        <?php echo $username."".$ran ?>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control" name="email" placeholder="Email" required autofocus>
                        </div>
                    </div>

                    <button class="btn btn-block btn-lg bg-light-blue waves-effect" name="submitForget" type="submit">RESET MY PASSWORD</button>

                    <div class="row m-t-20 m-b--5 align-center">
                        <a href="../.well-known/sign-in.php">Sign In!</a>
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