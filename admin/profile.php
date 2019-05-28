<?php
session_start();
$name=$course=$department=$profile=$email1=$id='';
$show=$_SESSION['user'];
if(strlen($_SESSION['user'] || strlen($_SESSION['role']))==0)
{
    echo '<script>window.location="sign-in.php"</script>';
}

?>

<!DOCTYPE html>
<html>

<?php require_once('../admin/links.php');

$show=$_SESSION['user'];
include('../admin/connection.php');
$sql2="SELECT * FROM noticeboard_members WHERE student_id = '".$show."'";
$query2=mysqli_query($conn,$sql2);
while($row2=mysqli_fetch_array($query2)){
    $id=$row2['student_id'];
    $name=$row2['fname'];
    $phone1=$row2['phone'];
    $email1=$row2['email'];
    $course=$row2['course'];
    $department=$row2['department'];
    $profile=$row2['photo'];
}
?>


<body class="theme-red">
    <!-- Page Loader -->
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
    <?php require_once('sidebar.php') ?>
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
   <?php require_once('topNav.php') ?>
    <!-- #Top Bar -->
    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-3">
                    <div class="card profile-card">
                        <div class="profile-header">&nbsp;</div>
                        <div class="profile-body">
                            <div class="image-area">
                                <img src="<?php echo '../pictures/'.$profile;?>" alt="No profile found" class="img-circle" width="100" height="100" />
                            </div>
                            <div class="content-area">
                                <h3><?php echo $name?></h3>
                                <p><?php echo $course?></p>
                                <p><?php echo $department ?></p>
                            </div>
                        </div>
                        <div class="profile-footer">
                            <ul>
                                <li>
                                    <span>Posts</span>
                                    <span>0</span>
                                </li>
                                <li>
                                    <span>Comments</span>
                                    <span>0</span>
                                </li>
                                <li>
                                    <span>Likes</span>
                                    <span>0</span>
                                </li>
                            </ul>
<!--                            <button class="btn btn-primary btn-lg waves-effect btn-block">FOLLOW</button>-->
                        </div>
                    </div>


                </div>
                <div class="col-xs-12 col-sm-9">
                    <div class="card">
                        <div class="body">
                            <div>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
                                    <li role="presentation"><a href="#profile_settings" aria-controls="settings" role="tab" data-toggle="tab">Profile Settings</a></li>
                                    <li role="presentation"><a href="#change_password_settings" aria-controls="settings" role="tab" data-toggle="tab">Change Password</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active" id="home">
                                        <div class="card card-about-me">
                                            <div class="header">
                                                <h2>ABOUT ME</h2>
                                            </div>
                                            <div class="body">
                                                <ul>
                                                    <li>
                                                        <div class="title">
                                                            <i class="material-icons">library_books</i>
                                                            Education
                                                        </div>
                                                        <div class="content">
                                                            B.S. in <?php echo $course ?> from the University of .......
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="title">
                                                            <i class="material-icons">location_on</i>
                                                            Location
                                                        </div>
                                                        <div class="content">
                                                           Add location
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="title">
                                                            <i class="material-icons">edit</i>
                                                            Skills
                                                        </div>
                                                        <div class="content">
<!--                                                            <span class="label bg-red">UI Design</span>-->
<!--                                                            <span class="label bg-teal">JavaScript</span>-->
<!--                                                            <span class="label bg-blue">PHP</span>-->
<!--                                                            <span class="label bg-amber">Node.js</span>-->
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="title">
                                                            <i class="material-icons">notes</i>
                                                            Description
                                                        </div>
                                                        <div class="content"> information about your self.
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
<!--                                        about me-->
                                    </div>

                                    <div role="tabpanel" class="tab-pane fade in" id="profile_settings">
                                        <form class="form-horizontal">
                                            <div class="form-group">
                                                <label for="NameSurname" class="col-sm-2 control-label">Name Surname</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="NameSurname" name="NameSurname" placeholder="Name Surname" value="<?php echo $name ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Email" class="col-sm-2 control-label">Email</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="email" class="form-control" id="Email" name="Email" placeholder="Email" value="<?php echo $email1 ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="phone" class="col-sm-2 control-label">Phone</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone" value="<?php echo $phone1 ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="phone" class="col-sm-2 control-label">Department</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="department" name="department" placeholder="department" value="<?php echo $department ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="course" class="col-sm-2 control-label">Course</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="course" name="course" placeholder="course" value="<?php echo $course ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="InputExperience" class="col-sm-2 control-label">Experience</label>

                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <textarea class="form-control" id="InputExperience" name="InputExperience" rows="3" placeholder="Experience"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="InputSkills" class="col-sm-2 control-label">Skills</label>

                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="InputSkills" name="InputSkills" placeholder="Skills">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <input type="checkbox" id="terms_condition_check" class="chk-col-red filled-in" />
                                                    <label for="terms_condition_check">I agree to the <a href="#">terms and conditions</a></label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" class="btn btn-info">UPDATE</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade in" id="change_password_settings">
                                        <form class="form-horizontal">
                                            <div class="form-group">
                                                <label for="OldPassword" class="col-sm-3 control-label">Old Password</label>
                                                <div class="col-sm-9">
                                                    <div class="form-line">
                                                        <input type="password" class="form-control" id="OldPassword" name="OldPassword" placeholder="Old Password" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="NewPassword" class="col-sm-3 control-label">New Password</label>
                                                <div class="col-sm-9">
                                                    <div class="form-line">
                                                        <input type="password" class="form-control" id="NewPassword" name="NewPassword" placeholder="New Password" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="NewPasswordConfirm" class="col-sm-3 control-label">New Password (Confirm)</label>
                                                <div class="col-sm-9">
                                                    <div class="form-line">
                                                        <input type="password" class="form-control" id="NewPasswordConfirm" name="NewPasswordConfirm" placeholder="New Password (Confirm)" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-9">
                                                    <button type="submit" class="btn btn-danger">SUBMIT</button>
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
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="../js/admin.js"></script>
    <script src="../js/pages/examples/profile.js"></script>

    <!-- Demo Js -->
    <script src="../js/demo.js"></script>
</body>

</html>
