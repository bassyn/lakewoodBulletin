<?php

if(!empty($_POST['email'])){
    $fromEmail = $_POST['email'];
}

if (!empty($_POST['message'])) {
    $message = $_POST['message'];
    $email= 'info@lakewoodbulletin.com';
    $subject = 'Inquiry through the Lakewood Bulletin';
    $emailMessage = "Message From: $fromEmail
                Message: $message";
                         
    $headers ='From: DO NOT REPLY <Do_Not_Reply@lakewoodbulletin.com>\r\n';
    mail($email, $subject, $emailMessage, $headers);
    include '../view/contactUs.php';
}

?>