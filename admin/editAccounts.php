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
    header('location:sign-in.php');
}
else{
    date_default_timezone_set('Asia/Kolkata');// change according timezone
    $currentTime = date( 'd-m-Y h:i:s A', time () );

    if(isset($_POST['updateUserAccount'])) {

        $name = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $role= $_POST['user_role'];
        $id = intval($_GET['id']);
        $sql =mysqli_query($conn,"update knp_account set username='$name',phone='$phone',email='$email',user_role='$role' where id='$id'");
        $_SESSION['msg'] = "Member data updated. Redirecting back please wait.....".mysqli_error($conn);
        echo "<script> setTimeout(function () {
             window.location.href= 'manageAccount.php'; // the redirect goes here
             },7000);</script>";

    }

    ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/html">
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

    <?php

    require_once ('topNav.php');
    require_once ('sidebar.php')
    ?>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Add post</h2>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <i class="material-icons"></i>
                            <h2>Edit User account.</h2>
                        </div>
                        <div class="panel-body">
                            <div class="card card-panel col-md-4 col-md-offset-4">
                                <div class="body">


                                    <?php if(isset($_POST['updateUserAccount']))
                                    {?>
                                        <div class="alert alert-success">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
                                        </div>
                                    <?php } ?>

                                    <br />


                                    <form id="sign_in" enctype="multipart/form-data" name="editAccounts" method="post" >
                                        <?php
                                        $id=intval($_GET['id']);
                                        $query=mysqli_query($conn,"select * from knp_account where id='$id'");
                                        while($row=mysqli_fetch_array($query))
                                        {
                                            ?>

                                            <div class="col-sm-12">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" id="username" name="username" value="<?php echo htmlentities($row['username']);?>" class="form-control" required>
                                                        <label for="username" class="form-label">Username</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="tel" id="phone" name="phone" value="<?php echo htmlentities($row['phone']);?>" class="form-control" required>
                                                        <label for="phone" class="form-label">Phone</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="email" id="email" name="email" value="<?php echo htmlentities($row['email']);?>" class="form-control" required>
                                                        <label for="email" class="form-label">Email</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <select class="form-control show-tick" name="user_role" id="user_role" required>
                                                    <option  value="<?php echo htmlentities($row['user_role']);?>"><?php echo htmlentities($row['user_role']);?></option>
                                                    <option>admin</option>
                                                    <option>member</option>
                                                </select>
                                            </div>

                                            <br>
                                            <br>

                                        <?php } ?>

                                        <div class="control-group">
                                            <div class="controls">
                                                <button type="submit" name="updateUserAccount" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </form>


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