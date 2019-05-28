<?php
/**
 * Created by PhpStorm.
 * User: CollyneJumah
 * Date: 01/18/2019
 * Time: 15:22
 */

function isLoggedIn()
{
    if (isset($_SESSION['user'])) {
        return true;
    }else{
        return false;
    }
}
?>