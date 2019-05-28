<?php
/**
 * Created by PhpStorm.
 * User: CollyneJumah
 * Date: 02/20/2019
 * Time: 09:01
 */


require_once ('connection.php');
session_start();
unset($_SESSION['showCourse']);

session_destroy();
header('location:index.php');
?>