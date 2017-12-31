#!/usr/local/bin/php -q

<?php
// fetch data from stdin

$cs = 'mysql:host=localhost;dbname=lakewoo1_bulletin_board';
$user = 'lakewoo1_bnussen';
$password = 'Tchooky18!';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

    try {
            $db = new PDO($cs, $user, $password, $options);
        } catch(PDOException $e) {
            $error = $e->getMessage();
            
            exit;
        }

$data = file_get_contents("php://stdin");
$pattern="/.*?To:\s*t([^@]+)@lakewoodbulletin.com/"; 
preg_match($pattern, $data, $matches);
 if (count($matches)) {

	$ticket=$matches[1];
    $patt="/:\s?\S*([^:]+)$/";
    preg_match($patt, $data, $match2);
    if (count($match2)) {
        $message=$match2[1];
	}
 }

if(isset($ticket)){
    $ticket= trim($ticket);
   	try{
        $query="SELECT m.to_id,m.from_id,m.conversation_id,m.listing_id,u.email FROM message m 
                INNER JOIN ticket t ON m.id=t.message_id INNER JOIN users u ON m.from_id=u.id WHERE t.id=:ticket";

        $statement = $db->prepare($query);
        $statement->bindValue(':ticket', $ticket);
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
	

            foreach ($rows as $row) {
                $email=$row['email'];
				$toId=$row['from_id'];
				$fromId=$row['to_id'];
				$conversationId=$row['conversation_id'];
				$listingId=$row['listing_id'];
   
              
            }				 
        }catch(PDOException $e) {
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";                 
            $headers.='From: DO NOT REPLY <Do_Not_Reply@lakewoodbulletin.com>\r\n';                    
            mail("ytnussen@gmail.com", "", ("error"), $headers);
        } 
        $query= "INSERT INTO message (from_id, to_id, listing_id, message,conversation_id) 
                    VALUES(:userId,:id,:listing,:message, $conversationId)";
        try{
            $statement = $db->prepare($query);
            $statement->bindValue(':userId',  $fromId);
            $statement->bindValue(':id', $toId);
            $statement->bindValue(':listing', $listingId);
            $statement->bindValue(':message', $message); 
           
            $statement->execute();
			$messageId= $db->lastInsertId();


			$subject="You have received a message through the Lakewood Bulletin";

            $emailMessage = "<html><body><p style='font-size: 1.5em;'>You have received the following message through the Lakewood Bulletin.</p><br/> 
                        
                    <p style='color: blue;'>Message:  $message</p>

                    <p style='font-size: 1.5em;'>Please log on to <a href='www.lakewoodbulletin.com'>www.lakewoodBulletin.com </a>and use the Message Center to respond.</p>
                    
                    <p style='font-size: 2em; text-align: center;'>Thank you for using the Lakewood Bulletin</p>
                    </body></html>";
			//$emailMessage="You have received the following message respond directly to this message to forward to sender $message";
		

            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";                 
            $headers.='From: DO NOT REPLY <Do_Not_Reply@lakewoodbulletin.com>\r\n';                    
            mail($email, $subject, $emailMessage, $headers);

        }catch(PDOException $e) {
           
        }        
			

    $query="SELECT u.cell,c.address FROM users u INNER JOIN carrier c ON u.carrier_id=c.id WHERE u.id=:userId";
        try{
            $statement = $db->prepare($query);
            $statement->bindValue(':userId', $toId);
            $statement->execute();
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC); 
            foreach ($rows as $row) {
                $cellNumber=$row['cell'];
                $address=$row['address'];
				
            }
        }catch(PDOException $e) { 
           
        } 
		
		if(isset($cellNumber)){
	
		    $textTo= $cellNumber.$address;
		    $query="INSERT INTO ticket (message_id) VALUES (:messageId)";
		
		    try{
                $statement = $db->prepare($query);
                $statement->bindValue(':messageId', $messageId);
                $statement->execute();
                $ticket=$db->lastInsertId();            
                $textMessage = "You have received the following message through the Lakewood Bulletin.
                                Message:  $message 
                                You can respond to the sender by responding directly to this message.                    
                                Thank you for using the Lakewood Bulletin";
                //$textMessage = wordwrap($textMessage, 20);

                $subject="You have received a message through the Lakewood Bulletin";
                $headers = "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";                 
                $headers.='From: <t'.$ticket.'@lakewoodbulletin.com>\r\n';                    

                $limit=160-(strlen(($ticket.'@lakewoodbulletin.com')));
                $start=0;
            
                $messageSize=strlen($textMessage);
                while($start<$messageSize){

                if($messageSize-$start<=$limit){
                    $thisShipment=substr($textMessage,$start);
                }else{
                    $thisShipment=substr($textMessage,$start,$limit);
                }
                $start=$start+$limit;

            
                mail($textTo,"", $thisShipment, $headers);
                sleep(5);

            
            }

                

                }catch(PDOException $e) {
                    mail("ytnussen@gmail.com", $subject, $e, $headers);
            }
		}else{mail("ytnussen@gmail.com", $subject, "this is from else", $headers);
        }

}




















?>