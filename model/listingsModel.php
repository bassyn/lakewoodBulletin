<?php
    require_once '../utils/db.php';
    require_once '../model/listing.php';

        if(!empty($_GET['category'])) {
            $category = $_GET['category'];
        }

        /*if(!empty($_GET['subcategory'])) {
            $subcategory = $_GET['subcategory'];
        }else {
            $subcategory = '';
        }*/

        try {
        $query = "SELECT l.id, price, photo, title From listings l inner join categories c on l.category=c.id WHERE 
                    c.name = :category ORDER BY date_posted DESC";  // AND subcategory = :subcategory)";
                    
        $database = Database::getInstance();
        $statement = $database->prepare($query);
        $statement->bindValue(':category', $category);
        //$statement->bindValue(':subcategory', $subcategory);
        $statement->execute();
            
        $listings = [];
            if($statement){
                foreach($statement as $listing) {
                    $listings[] = new Listing($listing);
                }

            }

        } catch(PDOException $e) {
            //$message = $e->getMessage();
            //require '../view/message.php';
            header('Location: ../index.php');
    }
    
?>