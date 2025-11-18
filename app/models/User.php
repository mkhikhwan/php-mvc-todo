<?php

class User{
    private $pdo;

    public function __construct($dbInstance){
        $this->pdo = $dbInstance->pdo;
    }

    public function findByUsername($username){
        $query = $this->pdo->prepare("SELECT * FROM users where username = :u LIMIT 1");
        $query->execute([':u' => $username]);
        return $query->fetch();
    }

    public function findByEmail($email){
        $query = $this->pdo->prepare("SELECT * FROM users where email = :e LIMIT 1");
        $query->execute([':e' => $email]);
        return $query->fetch();
    }

    public function findById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
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