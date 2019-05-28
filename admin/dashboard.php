<?php
require '../vendor/autoload.php';
require_once ('connection.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$msg=$status='';
if(isset($_GET['del']))
{
    require_once ('connection.php');
    mysqli_query($conn,"delete from knp_data where id = '".$_GET['id']."'");
    $msg = "<div class='alert alert-danger fade in'><a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>Account deleted successfully!</div>";
}
if(isset($_GET['approval']))
{
$sql="SELECT * FROM knp_data WHERE id = '".$_GET['id']."'";
$query = mysqli_query($conn,$sql);
while ($row1= mysqli_fetch_array($query)) {
    $email = $row1['email'];
    $surname=$row1['surname'];
    $name=$row1['otherName'];
    $fname=$surname.' '.$name;
    $level=$row1['category'];
    $course=$row1['course'];
}
    mysqli_query($conn,"update knp_data set status=1 where id = '".$_GET['id']."'");
    $em = new PHPMailer(true);
    try{
        $em->setFrom('_mainaccount@kisiipoly.ac.ke','KISIIPOLY');
        $em->isSMTP();
        $em->SMTPDebug = 3;
        $em->Port=25;
        $em->SMTPAuth = false;
        $em->SMTPSecure = false;
        $em->SMTPAutoTLS = false;
        $em->Host='localhost';
        $em->AddAddress($email);
        $em->Subject='COURSE APPROVAL UPDATES';
        $em->Body='Trust this finds you well. Following your application of study course named:';
        $em->send();
    }
    catch (Exception $e){
//        echo $e->errorMessage();
        $msg="<div class='alert alert-warning'>Warning! Cannot send email. Due to mail configuration fail in the serv</div>".$e->errorMessage();
    }
    catch (\Exception $e){
//        echo $e->getMessage();
        $msg="<div class='alert alert-danger'>Error! Cannot send email</div>".$e->getMessage();

    }

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
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">playlist_add_check</i>
                    </div>
                    <div class="content">
                        <div class="text">REGISTERED COURSES</div>
                        <div class="number count-to" data-from="0" data-to="1" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">library-books</i>
                    </div>
                    <div class="content">
                        <div class="text">SCHOOLS/FACULTY</div>
                        <div class="number count-to" data-from="0" data-to="0" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">forum</i>
                    </div>
                    <div class="content">
                        <div class="text">TOTAL APPLICANTS</div>
                        <div class="number count-to" data-from="0" data-to="0" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">mic</i>
                    </div>
                    <div class="content">
                        <div class="text">APPLICATION REQUESTS</div>
                        <div class="number count-to" data-from="0" data-to="0" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <span><?php echo $msg?></span>
                    </div>
                    <div class="body">
                        <a href="printList.php" target="_blank"><button type="submit" class="btn btn-default" style="padding-bottom: 5px" ><i class="material-icons">print</i> </button> </a>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">

                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Level</th>
                                    <th>Course Applying</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Level</th>
                                    <th>Course Applying</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                <?php
                                $count=1;
                                require_once('connection.php');
                                $sqlK="SELECT * FROM knp_data";
                                $queryK = mysqli_query($conn,$sqlK);
                                while ($row= mysqli_fetch_array($queryK))
                                {

                                    $surname=$row['surname'];
                                    $name=$row['otherName'];
                                    $fname=$surname.' '.$name;
                                    $level=$row['category'];
                                    $course=$row['course'];
                                    $id=$row['id'];
//                                    $gender=$row['gender'];
                                    $status=$row['status'];
                                    $email=$row['email'];
                                    $phone=$row['phone'];

                                    if($status==0){
                                        $status='<input type="submit" class="btn btn-danger btn-xs" value="Not approved">';
                                    }else{
                                        $status='<input type="submit" class="btn btn-success btn-xs" value="Approved">';
                                    }
                                    ;?>


                                    <tr class="odd gradeX">
                                        <td width="5%"><label class="label label-info"><?php echo $count ?></label></td>
                                        <td width="15%"><?php echo $fname ?></td>
                                        <td width="10%"><?php echo $level ?></td>
                                        <td width="15%"><?php echo $course ?></td>
                                        <td width="10%"><?php echo $phone ?></td>
                                        <td width=8%"><?php echo $email ?></td>
<!--                                        <td width=8%">--><?php //echo $gender ?><!--</td>-->
                                        <td width=5%"><?php echo $status ?></td>
                                        <td rowspan="1">
                                            <a href="edit_members.php?id=<?php echo $id?>" ><button type="submit" name="edit" class="btn btn-primary btn-xs" title="Edit user information"><i class="material-icons">edit</i></button></a>
                                            <a href="dashboard.php?id=<?php echo $id ?>&approval=approve" onClick="return confirm('Are you sure you want to approve this applicants')" title="Approve course"><button type="submit" name="approve" class="btn btn-success btn-xs"><i class="material-icons">done_all</i></button></a>
                                            <a href="dashboard.php?id=<?php echo $id ?>&disapproval=disapprove" onClick="return confirm('The applicant course will not be approved. Press OK if you want to continue?')" title="Disapprove course"><button type="submit" name="disapprove" class="btn btn-warning btn-xs"><i class="material-icons">done_all</i></button></a>
                                            <a href="dashboard.php?id=<?php echo $id ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" title="delete user permanently"><button type="submit" name="delete" class="btn btn-danger btn-xs"><i class="material-icons">delete_forever</i></button></a>

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
