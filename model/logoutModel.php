<?php

session_start();
$_SESSION['username'] = null;
$_SESSION['password']= null;
$_SESSION['login']= 'Login';
header('Location: ../index.php');
?>
