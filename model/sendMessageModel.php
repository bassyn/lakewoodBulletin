
<?php
if(!isset($_SESSION)) { 
    session_start(); 
}

require_once '../utils/db.php';

if(!isset($_SESSION['username']) || ($_SESSION['username'])==null){
    $message = "You must log in first";
    include '../view/message.php';
    exit;
}

$fromMessageCenter = false;
$id = $_POST['id'];

if (!empty($_POST['message'])) {

    $subject = "You have received a message through the Lakewood Bulletin";
    $message = $_POST['message'];

    if (!empty($_POST['user'])) {
        $fromMessageCenter=true;
        $query="SELECT u.email FROM users u WHERE u.id=:userId";
        try{
            $database = Database::getInstance();
            $statement = $database->prepare($query);
            $statement->bindValue(':userId', $_POST['user']);
            $statement->execute();
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                $toId=$_POST['user'];
                $email= $row['email'];
            }
        }catch(PDOException $e) {
            header('Location: ../index.php');
        } 
    }else{
        $query="SELECT u.id,u.email FROM users u INNER JOIN listings l ON u.username=l.posted_by WHERE l.id=:id ";

        try{
            $database = Database::getInstance();
            $statement = $database->prepare($query);
            $statement->bindValue(':id', $id);
            $statement->execute();
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                $toId=$row['id'];
                $email= $row['email'];
            }
        }catch(PDOException $e) {
            header('Location: ../index.php');
        }
    }

$query="SELECT id FROM conversation c WHERE (c.user_id_1=:from AND c.user_id_2=:to AND c.listing_id=:listingId) OR(c.user_id_1=:to AND c.user_id_2=:from AND c.listing_id=:listingId) ";

try{ //$message=":to is ".$toId." from is ". $_SESSION['id']." listing Id is ".$id;
            
            $database = Database::getInstance();
            $statement = $database->prepare($query);
            $statement->bindValue(':to', $toId);
            $statement->bindValue(':from', $_SESSION['id']);
            $statement->bindValue(':listingId', $id);
            $statement->execute();
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

            foreach ($rows as $row) {
    $conversationId=$row['id'];
}if(!isset($conversationId)){
    $query="INSERT INTO conversation (user_id_1,user_id_2,listing_id) VALUES (:thisUser,:otherUser,:listingId)";
    try{
            $database = Database::getInstance();
            $statement = $database->prepare($query);
            $statement->bindValue(':thisUser',  $_SESSION['id']);
            $statement->bindValue(':otherUser', $toId);
             $statement->bindValue(':listingId', $id);
             $statement->execute();
              }catch(PDOException $e) {}
    $conversationId="(select max(id) from conversation)";
     
} }catch(PDOException $e) {}
        
        
        
        
        
        $query= "INSERT INTO message (from_id, to_id, listing_id, message,conversation_id) VALUES(:userId,:id,:listing,:message,".$conversationId.")";
        try{
            $database = Database::getInstance();
            $statement = $database->prepare($query);
            $statement->bindValue(':userId',  $_SESSION['id']);
            $statement->bindValue(':id', $toId);
            $statement->bindValue(':listing', $id);
            $statement->bindValue(':message', $message); 
         
            $statement->execute();
            $messageId= $database->getLastId();
        }catch(PDOException $e) {
            header('Location: ../index.php');
        }        

        if($fromMessageCenter){
            include '../view/messages.php';
        }else{
            include '../view/listingDetails.php';
        }

    $emailMessage = "<html><body><p style='font-size: 1.5em;'>You have received the following message through the Lakewood Bulletin.</p> 
                        
                    <p style='color: blue;'>Message:  $message</p>
                        
                    <p style='font-size: 1.5em;'>Please log on to <a href='www.lakewoodBulletin.com'>www.lakewoodBulletin.com</a> and use the Message Center to respond.</p>
                    
                    <p style='font-size: 2em; text-align: center;'>Thank you for using the Lakewood Bulletin</p>
                    </body></html>";

    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";                 
    $headers.='From: DO NOT REPLY <Do_Not_Reply@lakewoodbulletin.com>\r\n';                    
    mail($email, $subject, $emailMessage, $headers);
    include 'sendTextModel.php';
}?>