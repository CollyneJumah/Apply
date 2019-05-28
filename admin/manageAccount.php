<?php
@session_start();
if(strlen($_SESSION['user'] || strlen($_SESSION['role']))==0)
{
    echo '<script>window.location="sign-in.php"</script>';
}

$msg='';
if(isset($_GET['del']))
{
    require_once ('connection.php');
    mysqli_query($conn,"delete from knp_account where id = '".$_GET['id']."'");
    $msg = "<div class='alert alert-danger fade in'><a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>Account deleted successfully!</div>";
}

if(isset($_GET['blc']))
{
    require_once ('connection.php');
    mysqli_query($conn,"UPDATE knp_account SET user_role='member' where id = '".$_GET['id']."'");
    $msg = "<div class='alert alert-danger fade in'><a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>Account Blocked!</div>";
}

?>
<!DOCTYPE html>
<html>

<?php require_once ('links.php')?>
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
<?php require_once ('topNav.php')?>
<!-- #Top Bar -->
<?php require_once ('sidebar.php')?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                <i class="material-icons">assignment</i>Registered Users

            </h2>
        </div>

        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Manage user Accounts
                        </h2>
                        <span><?php echo $msg?></span>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>username</th>
                                    <th>Email</th>
                                    <th>phone</th>
                                    <th>Role</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>username</th>
                                    <th>Email</th>
                                    <th>phone</th>
                                    <th>Role</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                <?php
                                $count=1;
                                require_once('connection.php');
                                $imageType=array('jpeg','jpg','png','gif');
                                $sql="SELECT * FROM knp_account";

                                $query = mysqli_query($conn,$sql);
                                while ($row= mysqli_fetch_array($query))
                                {

                                    $name=$row['username'];
                                    $id=$row['id'];
                                    $email=$row['email'];
                                    $phone=$row['phone'];
                                    $role=$row['user_role'];
                                    $time=$row['time'];
                                    ;?>

                                    <tr class="odd gradeX">
                                        <td width="5%"><label class="label label-info"><?php echo $count ?></label></td>
                                        <td width="15%"><?php echo $name ?></td>
                                        <td width="7%"><?php echo $email ?></td>
                                        <td width="5%"><?php echo $phone ?></td>
                                        <td width=8%"><?php echo $role ?></td>
                                        <td width=20%"><?php echo $time ?></td>

                                        <td rowspan="1">
                                            <a href="editAccounts.php?id=<?php echo $id?>" ><button type="submit" name="edit" class="btn btn-primary btn-xs" title="Edit user information"><i class="material-icons">edit</i></button></a>
                                            <a href="manageAccount.php?id=<?php echo $id ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" title="delete user permanently"><button type="submit" name="delete" class="btn btn-danger btn-xs"><i class="material-icons">delete_forever</i></button></a>
                                            <a href="manageAccount.php?id=<?php echo $id ?>&blc=block" onClick="return confirm('Are you sure you want to block this account? User will not be able to access the page')" title="Block user "><button type="submit" name="block" class="btn btn-warning btn-xs"><i class="material-icons">block</i></button></a>

                                    </tr>


                                    <?php
                                    $count=$count+1;
                                };

                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
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

<!-- Jquery DataTable Plugin Js -->
<script src="../plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="../plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="../plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="../plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="../plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="../plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="../plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="../plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

<!-- Custom Js -->
<script src="../js/admin.js"></script>
<script src="../js/pages/tables/jquery-datatable.js"></script>

<!-- Demo Js -->
<script src="../js/demo.js"></script>
</body>

</html>
