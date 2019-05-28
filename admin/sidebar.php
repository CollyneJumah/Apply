<?php
/**
 * Created by PhpStorm.
 * User: CollyneJumah
 * Date: 01/08/2019
 * Time: 13:37
 */
@session_start();
$username=$email1=$photo=$phone1='';
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


<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
<!--                <img src="--><?php //echo '../pictures/'.$photo;?><!--" width="48" height="48" alt="User" />-->
                <img src="../image/knp.jpg" width="100" height="100" class="img-responsive" alt="User" />
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">MAIN NAVIGATION</li>
                <li class="active">
                    <a href="index.php">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">settings</i>
                        <span>Settings</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="addCourse.php">Add new course</a>
                        </li>
                        <li>
                            <a href="allCourses.php">Available Courses</a>
                        </li>
                        <li>
                            <a href="manageAccount.php">Manage Accounts</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->

    </aside>
</section>
