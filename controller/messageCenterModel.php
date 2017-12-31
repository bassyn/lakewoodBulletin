<?php
    require_once '../utils/db.php';
 
 $query= "select m.message,m.from_id, l.photo,l.title,l.id, u.email, u.username, tu.username from message m inner join users u on m.from_id=u.id inner join listings l on m.listing_id=l.id inner join users tu on listings.to_id=tu.id where m.to_id=:id or m.from_id=:id order by l.id,m.time ";
    try{
        $database = Database::getInstance();
        $statement = $database->prepare($query);
        $statement->bindValue(':id', $_SESSION['id']);
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e) {echo $e;} 
 
 
 ?>