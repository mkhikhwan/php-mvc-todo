<?php

class Task{
    private $pdo;

    public function __construct($dbInstance){
        $this->pdo = $dbInstance->pdo;
    }

    public function getAllTasks($user_id){
        $query = $this->pdo->prepare("SELECT * FROM tasks where user_id = :u ORDER BY created_date DESC");
        $query->execute([':u' => $user_id]);
        return $query->fetchAll();
    }

    public function create($user_id, $taskname, $taskdescription, $taskDue, $taskPriority){
        $stmt = $this->pdo->prepare("INSERT INTO Tasks (user_id, name, description, due_date, priority) VALUES (:user_id, :name, :desc, :due, :priority)");
        return $stmt->execute([
            ':user_id' => $user_id,
            ':name' => $taskname,
            ':desc' => $taskdescription,
            ':due' => $taskDue,
            ':priority' => $taskPriority
        ]);
    }

    public function deleteTask($task_id){
        $stmt = $this->pdo->prepare("DELETE FROM Tasks WHERE id = :id");
        return $stmt->execute([
            ':id' => $task_id
        ]);
    }
}


?>