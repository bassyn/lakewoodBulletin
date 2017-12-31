<?php

require '../utils/db.php';

$db = Database::getInstance();

if(isset($_POST['username'])){
    $statement= $db->prepare('SELECT * FROM users WHERE username = :username');
    $statement->bindParam(':username', $username);
    $statement->execute();
    $statement->fetchAll();
    if(($statement->rowCount())>0){
        $message = "Username already exists";
        require '../view/message.php';
        exit;
    }else {
        $username = $_POST['username'];
    }
}else{
    $message = "You must enter a username";
    require '../view/message.php';
	exit;
}

if(strlen($username) > 30){
    //header('Location: login.php');
    $message = "User name is to long";
	require '../view/message.php';
	exit;
}

if(isset($_POST['password1'])){
    $password1 = $_POST['password1'];
}else{
    $message = "You must enter a password";
    require '../view/message.php';
	exit;
}

if(isset($_POST['password2'])){
    $password2 = $_POST['password2'];
}else{
    $message = "You must re-enter your password";	
    require '../view/message.php';
	exit;
}

if($password1 != $password2) {
    //header('Location: login.php');
    $message = "Your passwords do not match";
	require '../view/message.php';
	exit;
}
//if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // invalid emailaddress
//}

if(isset($_POST['email'])&&filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    $email = $_POST['email'];
}else {
    $message = "You must enter a valid email address";
    require '../view/message.php';
	exit;
}

if(!empty($_POST['cell'])){
    $cell = $_POST['cell'];
    $justNums = preg_replace("/[^0-9]/", '', $cell);
    if (strlen($justNums) == 11) $justNums = preg_replace("/^1/", '',$justNums);
    if (strlen($justNums) !== 10) {
        $message = "You must enter a valid cell phone number";
        require '../view/message.php';
        exit;
    }
    $cell = $justNums;
}else {
    $cell = '';
}

if(!empty($_POST['cell']) && $_POST['carrier_id'] == 0){
    $message = "You must select a carrier";
    require '../view/message.php';
    exit;
}

if(isset($_POST['carrier_id'])){
    $carrier_id = $_POST['carrier_id'];
}else{
    $carrier_id = '';
}

$password = password_hash($password1, PASSWORD_DEFAULT);
 
$statement = $db->prepare('INSERT INTO users (username, password, email, cell, carrier_id) VALUES (:username, :password, :email, :cell, :carrier_id)');
$statement->bindParam(':username', $username);
$statement->bindParam(':password', $password);
$statement->bindParam(':email', $email);
$statement->bindParam(':cell', $cell);
$statement->bindParam(':carrier_id', $carrier_id);
$statement->execute();

 

//header('Location: ../view/login.php');
$_POST['password'] = $password1;
include 'loginModel.php';

?>