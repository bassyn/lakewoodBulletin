<?php
require_once '../utils/db.php';

if(!isset($_SESSION)) { 
    session_start(); 
}

$username= $_SESSION['username'];
$date = date("Y-m-d");

if (!empty($_POST['title'])) {
    $title = $_POST['title'];
}
    
if (!empty($_POST['category'])) {
    $category = $_POST['category'];
} 

if(!empty($_POST['price'])){
    $price = $_POST['price'];
}

if(!empty($_POST['contact'])){
    $contact = $_POST['contact'];
}else{
    $contact = '';
}

if(!empty($_POST['description'])){
    $description = $_POST['description'];
}

if(!empty($_FILES['mainPhoto']['name'])){
    $dir='../images/';
    $mainPhoto=$dir . basename($_FILES['mainPhoto']['name']);

    $mainPhoto=str_replace(" ","_",$mainPhoto);
    $fileType = pathinfo($mainPhoto,PATHINFO_EXTENSION);

    if($fileType != "JPG" && $fileType != "PNG" && $fileType != "JPEG" && $fileType != "GIF" 
            && $fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif" ) {
        $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $addedListing = true;
        require '../view/message.php';
        exit;
    }

    $x=0;
    while (file_exists($additionaPhotos1)) {
        $x++;
        $additionaPhotos1=$additionaPhotos1.$x;
    }

    move_uploaded_file($_FILES["mainPhoto"]["tmp_name"],$mainPhoto);
}else{
    $mainPhoto = '';
}


try {
    $query = "INSERT INTO listings (title, category, description, price, photo, contact, posted_by, date_posted) 
                VALUES (:title, :category, :description, :price, :photo, :contact, :posted_by, :date_posted)";
                
    $database = Database::getInstance();
    $statement = $database->prepare($query);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':category', $category);
    $statement->bindValue(':description', $description);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':photo', $mainPhoto);
    $statement->bindValue(':contact', $contact);
    $statement->bindValue(':posted_by', $username);
    $statement->bindValue(':date_posted', $date);
    $statement->execute();

} catch(PDOException $e) {
    $message = $e->getMessage();
    require '../view/message.php';
    header('Location: ../index.php');
}

try {
    $query = "SELECT id FROM listings WHERE (posted_by= :username AND title=:title AND category = :category)";
                
    $database = Database::getInstance();
    $statement = $database->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':category', $category);
    $statement->bindValue(':title', $title);
    $statement->execute();
    $id= $statement->fetchAll();
} catch(PDOException $e) {
    //$message = $e->getMessage();
    //require '../view/message.php';
    header('Location: ../index.php');
}

    if(!empty($_FILES["additionalPhotos1"]["name"])){
        $dir='../images/';
        $additionaPhotos1=$dir . basename($_FILES["additionalPhotos1"]["name"]);
        $additionaPhotos1=str_replace(" ","_",$additionaPhotos1);
        $fileType = pathinfo($additionaPhotos1,PATHINFO_EXTENSION);

        if($fileType != "JPG" && $fileType != "PNG" && $fileType != "JPEG" && $fileType != "GIF" 
            && $fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif" ) {
            $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $addedListing = true;
            require '../view/message.php';
            exit;
        }

        $x=0;
        while (file_exists($additionaPhotos1)) {
            $x++;
            $additionaPhotos1=$additionaPhotos1.$x;
        }
        move_uploaded_file($_FILES["additionalPhotos1"]["tmp_name"],$additionaPhotos1);
        try {
            $query = "INSERT INTO images (image_path, listing_id) 
                        VALUES (:imagePath, :listing_id)";
                        
            $database = Database::getInstance();
            $statement = $database->prepare($query);
            $statement->bindValue(':imagePath', $additionaPhotos1);
            $statement->bindValue(':listing_id', $id[0]['id']);
            $statement->execute();
        } catch(PDOException $e) {
            //$message = $e->getMessage();
            //require '../view/message.php';
            header('Location: ../index.php');
        }
    }

    if(!empty($_FILES["additionalPhotos2"]["name"])){
        $dir='../images/';
        $additionaPhotos2=$dir . basename($_FILES["additionalPhotos2"]["name"]);
        $additionaPhotos2=str_replace(" ","_",$additionaPhotos2);
        $fileType = pathinfo($additionaPhotos2,PATHINFO_EXTENSION);

        if($fileType != "JPG" && $fileType != "PNG" && $fileType != "JPEG" && $fileType != "GIF" 
            && $fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif" ) {
            $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $addedListing = true;
            require '../view/message.php';
            exit;
        }

        $x=0;
        while (file_exists($additionaPhotos2)) {
            $x++;
            $additionaPhotos2=$additionaPhotos2.$x;
        }  

        move_uploaded_file($_FILES["additionalPhotos2"]["tmp_name"],$additionaPhotos2);
        try {
            $query = "INSERT INTO images (image_path, listing_id) 
                        VALUES (:imagePath, :listing_id)";
                        
            $database = Database::getInstance();
            $statement = $database->prepare($query);
            $statement->bindValue(':imagePath', $additionaPhotos2);
            $statement->bindValue(':listing_id', $id[0]['id']);
            $statement->execute();
        } catch(PDOException $e) {
            //$message = $e->getMessage();
            //require '../view/message.php';
            header('Location: ../index.php');
        }
    }

    if(!empty($_FILES["additionalPhotos3"]["name"])){
        $dir='../images/';
        $additionalPhotos3=$dir . basename($_FILES["additionalPhotos3"]["name"]);
        $additionalPhotos3=str_replace(" ","_",$additionalPhotos3);
        $fileType = pathinfo($additionalPhotos3,PATHINFO_EXTENSION);

        if($fileType != "JPG" && $fileType != "PNG" && $fileType != "JPEG" && $fileType != "GIF" 
            && $fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif" ) {
            $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $addedListing = true;
            require '../view/message.php';
            exit;
        }

        $x=0;
        
        while (file_exists($additionalPhotos3)) {
            $x++;
            $additionalPhotos3=$additionalPhotos3.$x;
        }
        move_uploaded_file($_FILES["additionalPhotos3"]["tmp_name"],$additionalPhotos3);
        try {
            $query = "INSERT INTO images (image_path, listing_id) 
                        VALUES (:imagePath, :listing_id)";
                        
            $database = Database::getInstance();
            $statement = $database->prepare($query);
            $statement->bindValue(':imagePath', $additionalPhotos3);
            $statement->bindValue(':listing_id', $id[0]['id']);
            $statement->execute();
         } catch(PDOException $e) {
            //$message = $e->getMessage();
            //require '../view/message.php';
            header('Location: ../index.php');
        }
    }


        $message = "You have successfully added a listing.";
        $addedListing = true;
        require '../view/message.php';
        exit;




?>