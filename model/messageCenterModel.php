<?php
    require_once '../utils/db.php';
 
 $query= "SELECT m.message, m.from_id, l.photo, l.title, l.id listingId, u.email, u.username sender, u.id senderId, tu.username receiver, tu.id receiverId 
            FROM message m INNER JOIN users u ON m.from_id=u.id 
            INNER JOIN listings l ON m.listing_id=l.id INNER JOIN users tu ON m.to_id=tu.id  
            WHERE m.to_id=:id or m.from_id=:id ORDER BY  m.conversation_id,  listingId, m.time ";
    try{
        $database = Database::getInstance();
        $statement = $database->prepare($query);
        $statement->bindValue(':id', $_SESSION['id']);
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e) {
        header('Location: ../index.php');
    } 
 
 
 ?>