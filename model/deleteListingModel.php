<?php
require_once '../utils/db.php';

if(!isset($_SESSION)) { 
    session_start(); 
}

$posted_by = $_SESSION['username'];


    try {
        $query = "SELECT id, title From listings WHERE posted_by = :posted_by";
                    
        $database = Database::getInstance();
        $statement = $database->prepare($query);
        $statement->bindValue(':posted_by', $posted_by);
        $statement->execute();
            
            if($statement){
                $listings = $statement->fetchAll();
            }

    } catch(PDOException $e) {
        //$message = $e->getMessage();
        //require 'view/message.php';
        header('Location: ../index.php');
    }
    
?>