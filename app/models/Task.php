<?php

class Task{
    private $pdo;

    public function __construct($dbInstance){
        $this->pdo = $dbInstance->pdo;
    }

    public function getAllTasks($user_id){
        $query = $this->pdo->prepare("SELECT * FROM tasks where user_id = :u");
        $query->execute([':u' => $user_id]);
        return $query->fetchAll();
    }

    public function create($username, $email, $passwordHash){
        $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password) VALUES (:u, :e, :p)");
        return $stmt->execute([
            ':u' => $username,
            ':e' => $email,
            ':p' => $passwordHash
        ]);
    }
}


?>