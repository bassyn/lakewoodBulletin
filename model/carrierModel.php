<?php
    require_once '../utils/db.php';

    try {
        $query = "SELECT id, name FROM carrier"; 
                    
        $database = Database::getInstance();
        $statement = $database->prepare($query);
        $statement->execute();
            if ($statement) {
				$carriers = $statement->fetchAll();
			}


        } catch(PDOException $e) {
            //$message = $e->getMessage();
            //require '../view/message.php';
            header('Location: ../index.php');
    }

?>