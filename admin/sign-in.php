<?php
@session_start();
$hashPass=$email=$student_id=$status=$emailErr=$username=$password=$error='';

if(isset($_POST['sign_in'])) {
    include('connection.php');
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $sql = "SELECT * FROM knp_account WHERE username= '" .$username. "' or password='".$password."'";

    $results = mysqli_query($conn, $sql);
    $resultSta = mysqli_query($conn, $sql);
    $checkUser = mysqli_num_rows($results);
    while ($ro = mysqli_fetch_array($resultSta)) {
        $status=$ro['status'];
    }

    //end remember me
    if($checkUser ==0){
        $error="<p class='alert alert-danger fade in '><a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a><strong>Error!</strong>Username or password does not exist.Contact system administrator.<label>*</label></p>".mysqli_error($conn) ;
    }

    else {
        if ($row = mysqli_fetch_assoc($results)) {
            $hashPass = password_verify($password, $row['password']);
            $role=$row['user_role'];
        }

        if ($hashPass == false) {
            $error="<p class='alert alert-danger fade in '><a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a><strong>Error!</strong>Membership Id or password does not match the records we have. Please try again.<label>*</label>.".mysqli_error($conn)."</p>" ;
        } elseif ($hashPass == true) {
            $_SESSION['user'] =$username;
            $_SESSION['role'] =$role;

            if($role=='admin'){
                echo '<script>window.location="index.php"</script>';
            }else{
                echo "<p class='alert alert-warning fade in '><a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>You have no permissions to access this account. Contact system administrator <label>*</label>.".mysqli_error($conn)."</p>" ;

            }


        }

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
                <form id="sign_in" method="POST" action="sign-in.php" enctype="multipart/form-data">
                    <div class="msg">Sign in As an Administrator</div>
                    <span><?php echo $error?></span>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" id="username" placeholder="username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Remember Me</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-green waves-effect" name="sign_in" type="submit">SIGN IN</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            <a href="sign-up.php" style="color: #337a07;">Register Now!</a>
                        </div>
                        <div class="col-xs-6 align-right">
                            <a href="forgot-password.php"  style="color: #337a07;">Forgot Password?</a>
                        </div>
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
    <script src="../js/pages/examples/sign-in.js"></script>
</body>

</html>