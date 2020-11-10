<?php

session_start();
$_SESSION = array();
unset($_SESSION['KCFINDER']['disabled']);
session_destroy();
header("Cache-Control:no-cache");
header('location:../index.php');
?>

