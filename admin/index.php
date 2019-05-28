<?php
@session_start();
$role=$user='';
$user=$_SESSION['user'];
$role=$_SESSION['role'];
if(strlen($user || strlen($role))==0)
{
    echo '<script>window.location="sign-in.php"</script>';
}

?>
<!DOCTYPE html>
<html>

<?php require_once('links.php') ?>
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
   <?php require_once('sidebar.php') ?>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->

        <!-- #END# Right Sidebar -->

    <?php require_once('dashboard.php') ?>

</body>

</html>
