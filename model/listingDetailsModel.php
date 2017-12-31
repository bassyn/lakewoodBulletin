<?php
    require_once '../utils/db.php';
    require_once '../model/listing.php';

    try {
        $query = "SELECT id, price, description, photo, title, category, contact From listings WHERE id = :id";
                    
        $database = Database::getInstance();
        $statement = $database->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();
            
            $listings = [];
            if($statement){
                foreach($statement as $listing){
                    $listings[] = new Listing($listing);
                }

            } 

        } catch(PDOException $e) {
            //$message = $e->getMessage();
            //require '../view/message.php';
            header('Location: ../index.php');
    }

    try {
        $query = "SELECT image_path FROM images WHERE listing_id = :id";
                    
        $database = Database::getInstance();
        $statement = $database->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();
            
            if(($statement->rowCount())>0){
                $images= $statement->fetchAll();
            }
            

        } catch(PDOException $e) {
            //$message = $e->getMessage();
            //require '../view/message.php';
            header('Location: ../index.php');
    }
    
?>