<?php

class Database {
    private static $instance;
    private $db;

    private function __construct() {
        $cs = 'mysql:host=localhost;dbname=lakewoo1_bulletin_board';
        $user = '';
        $password = '';
        $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

        try {
            $this->db = new PDO($cs, $user, $password, $options);
        } catch(PDOException $e) {
            $error = $e->getMessage();
            //require 'views/error.php';
            exit;
        }
    }


    public function prepare($query) {
        return $this->db->prepare($query);
    }
     public function getLastId(){
         return $this->db->lastInsertId();
     }

    public static function getInstance() {
        if(! self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
}
?>