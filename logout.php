<?php
/**
 * Created by PhpStorm.
 * User: kyle
 * Date: 10/19/17
 * Time: 5:25 AM
 */
session_start();
$_SESSION['user'] = null;
header('location: ./login/index.php?signout=true');
