<?php
/**
 * Created by PhpStorm.
 * User: CollyneJumah
 * Date: 01/08/2019
 * Time: 17:07
 */

require_once('connection.php');
session_start();
//unset($_SESSION['login']);
unset($_SESSION['user']);

session_destroy();
header('location:sign-in.php');
?>