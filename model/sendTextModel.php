 
 <?php

 $query="SELECT u.cell,c.address FROM users u INNER JOIN carrier c ON u.carrier_id=c.id WHERE u.id=:userId";
        try{
            $database = Database::getInstance();
            $statement = $database->prepare($query);
            $statement->bindValue(':userId', $toId);
            $statement->execute();
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC); 
            foreach ($rows as $row) {
                $cellNumber=$row['cell'];
                $address=$row['address'];
				
            }
        }catch(PDOException $e) { mail("ytnussen@gmail.com", $subject, $e, $headers);
           
        } 
		
	if(isset($cellNumber)){
	
		$textTo= $cellNumber.$address;
		

		$query="INSERT INTO ticket (message_id) VALUES (:messageId)";
		
		try{
            $database = Database::getInstance();
            $statement = $database->prepare($query);
            $statement->bindValue(':messageId', $messageId);
            $statement->execute();
			$ticket=$database->getLastId();            
            $textMessage = "You have received the following message through the Lakewood Bulletin.
                            Message:  $message 
                            You can respond to the sender by responding directly to this message.                    
                            Thank you for using the Lakewood Bulletin";
            //$textMessage = wordwrap($textMessage, 20, '<br/>');
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


        
		?>