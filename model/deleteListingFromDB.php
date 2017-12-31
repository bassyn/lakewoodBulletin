<?php

require_once '../utils/db.php';
if(!isset($_SESSION)) { 
    session_start(); 
}

$username = $_SESSION['username'];

if(!empty($_POST['id'])) {
    $id = $_POST['id']; 
}

   try {
        $query = "SELECT image_path FROM images WHERE (listing_id = :id)";     
        $database = Database::getInstance();
        $statement = $database->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();
        print_r($statement);
        if($statement){
            $images= $statement->fetchAll();
        }
            foreach($images as $image){
                unlink($image['image_path']);
            }
    } catch(PDOException $e) {
        //$message = $e->getMessage();
        //require '../view/message.php';
        header('Location: ../index.php');
    }

    try {
        $query = "SELECT photo FROM listings WHERE (id = :id)";     
        $database = Database::getInstance();
        $statement = $database->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();
        if($statement){
            $images= $statement->fetchAll();
        }
            foreach($images as $image){
                unlink($image['photo']);
            }
    } catch(PDOException $e) {
        //$message = $e->getMessage();
        //require '../view/message.php';
        header('Location: ../index.php');
    }


    try {
        $query = "DELETE FROM images WHERE (listing_id = :id)";     
        $database = Database::getInstance();
        $statement = $database->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();
    } catch(PDOException $e) {
        //$message = $e->getMessage();
        //require '../view/message.php';
        header('Location: ../index.php');
    }

    try {
        $query = "DELETE FROM listings WHERE (posted_by = :posted_by AND id = :id)";     
        $database = Database::getInstance();
        $statement = $database->prepare($query);
        $statement->bindValue(':posted_by', $username);
        $statement->bindValue(':id', $id);
        $statement->execute();
    } catch(PDOException $e) {
        //$message = $e->getMessage();
        //require '../view/message.php';
        header('Location: ../index.php');
    }

    
    
?>