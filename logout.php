<?php 
include 'config.php';
session_start();
session_destroy();
header('Location:' .URL. 'login.php');

?>

