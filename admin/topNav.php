<?php
/**
 * Created by PhpStorm.
 * User: CollyneJumah
 * Date: 01/08/2019
 * Time: 13:27
 */
@session_start();
$username=$email=$photo=$phone='';
include('connection.php');
$show=$_SESSION['user'];

$sql2="SELECT * FROM knp_account WHERE email = '" . $show. "'";

$query2=mysqli_query($conn,$sql2);

while($row2=mysqli_fetch_array($query2)){
    $id=$row2['id'];
    $username=$row2['username'];
    $phone=$row2['phone'];
    $email=$row2['email'];
}
?>

<nav class="navbar" style="background: #337a07">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="index.php">Course Applicants</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <!-- Call Search -->
                <li><span>Welcome  <?php $email ?></span></li>
                <li><a href="../index.php" target="_blank" class="login-box" data-close="true"><input type="submit" value="applicant form" class="btn btn-success btn-xs"></a></li>
                <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                <li><a href="sign-in.php" class="login-box" data-close="true"><i class="material-icons">account_box</i></a>Login</li>
                <li><a href="sign_out.php" class="login-box" data-close="true"><i class="material-icons">account_circle</i></a>Sign Out</li>

            </ul>
        </div>
    </div>
</nav>
