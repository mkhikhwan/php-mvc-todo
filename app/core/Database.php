<?php

class Database{
    private $host = '127.0.0.1';
    private $db = 'php-todo';
    private $user = 'root';
    private $pass = '';
    public $pdo;
    static private $instance;

    private function __construct(){
        try{
            $this->pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->db};charset=utf8mb4",
                $this->user,
                $this->pass,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
                );
        }catch(PDOException $e){
            die("DB connect error: " . $e->getMessage());
        }
    }

    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new self();
        }

        return self::$instance;
    }
}


?>