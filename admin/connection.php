<?php
/**
 * Created by PhpStorm.
 * User: CollyneJumah
 * Date: 01/08/2019
 * Time: 17:08
 */

////
//$servername = "localhost";
//$username = "kisiipoly_apply";
//$password = "kisiipoly@1234";
//$db = "kisiipoly_apply";
////// Create connection
//$conn = new mysqli($servername, $username, $password,$db);
////// Check connection
////
//if ($conn->connect_error) {
////
//   die("Connection failed: " . $conn->connect_error);
////
//}


$servername = "localhost";
$username = "root";
$password = "";
$db = "kisiipoly_apply";
//// Create connection
$conn = new mysqli($servername, $username, $password,$db);
//// Check connection
//
if ($conn->connect_error) {
//
   die("Connection failed: " . $conn->connect_error);
//
}

?>
