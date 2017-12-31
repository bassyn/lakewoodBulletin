<?php
if(!isset($_SESSION)) { 
    session_start(); 
}
require_once '../utils/db.php';

$db = Database::getInstance();

if (!empty($_POST['username'])) {
        $username = $_POST['username'];
    } else {
        $_SESSION['login']= 'Login';
        $message = "A valid user name must be entered";
        require '../view/message.php';
        exit;
    }
    
if (!empty($_POST['password'])) {
    $password = $_POST['password'];
    $_SESSION['password'] = $password;
} else {
    $_SESSION['login']= 'Login';
    $message = "A valid password must be entered";
    require '../view/message.php';
    exit;
}
  
$query = "SELECT id, password, username FROM users WHERE username = :username";
 
$result = $db->prepare($query);
$result->bindParam(":username", $username);
$result->execute();
 
$number_of_rows = $result->rowCount();
 
if($number_of_rows == 0) // User not found. So, redirect to login_form again.
{
    $_SESSION['login']= 'Login';
    $message = "User not Found";
	require '../view/message.php';
	exit;
}
 
$userData  = $result->fetch(PDO::FETCH_ASSOC); 

if(!password_verify($password, $userData['password'])) // Incorrect password. So, redirect to login_form again.
{
    $_SESSION['login']= 'Login';
    $message = "Incorrect Password";
	require '../view/message.php';
	exit;
}else{ // Redirect to home page after successful login.
    $_SESSION['login']= 'Logout';
    $message = "Welcome $username";
    $_SESSION['username'] = $userData['username'];
    $_SESSION['id']=$userData['id'];  
    $loggedIn = true;
	require '../view/message.php';
    exit;
}

?>