<?php

class Task{
    private $pdo;

    public function __construct($dbInstance){
        $this->pdo = $dbInstance->pdo;
    }

    public function getAllTasks($user_id){
        $stmt = "SELECT * FROM tasks WHERE 1=1 AND user_id = :u ";
        $placeholder = [':u' => $user_id];

        if(isset($_GET['completion']) && $_GET['completion'] !== ""){
            $stmt .= "AND is_done = :done ";
            $placeholder[':done'] = $_GET['completion'];
        }
        if(isset($_GET['due_after']) && $_GET['due_after'] !== ""){
            $stmt .= "AND due_date > :due_after ";
            $placeholder[':due_after'] = $_GET['due_after'];
        }
        if(isset($_GET['due_before']) && $_GET['due_before'] !== ""){
            $stmt .= "AND due_date < :due_before ";
            $placeholder[':due_before'] = $_GET['due_before'];
        }
        if(isset($_GET['priority']) && !empty($_GET['priority'])){
            $priorityArr = $_GET['priority'];
            $priorityPlaceholder = [];
            foreach($priorityArr as $index => $priority){
                $priorityPlaceholder[] = ":$priority";
                $placeholder[":$priority"] = $priority;
            }
            $stmt .= "AND priority IN (" . implode(", ",$priorityPlaceholder) .") ";
        }
        if(isset($_GET['name']) && $_GET['name'] !== ""){
            $name = $_GET['name'];
            $stmt .= "AND name LIKE '%$name%' ";
        }

        $stmt .= "ORDER BY created_date DESC";

        $query = $this->pdo->prepare($stmt);
        $query->execute($placeholder);
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

    public function setTaskDone($task_id, $isDone){
        $stmt = $this->pdo->prepare("UPDATE Tasks SET is_done = :d WHERE id = :id");
        return $stmt->execute([
            ':id' => $task_id,
            ':d' => $isDone ? 1 : 0
        ]);
    }

    public function viewTask($task_id){
        $stmt = $this->pdo->prepare("SELECT * FROM Tasks WHERE id = :task_id LIMIT 1");
        $stmt->execute([
            ':task_id' => filter_var($task_id, FILTER_VALIDATE_INT)
        ]);
        
        return $stmt->fetch();
    }

    public function editTask($task_id, $taskname, $taskdescription, $taskDue, $taskPriority){
        $stmt = $this->pdo->prepare("
            UPDATE Tasks SET
                name = :name, 
                description = :desc, 
                due_date = :due, 
                priority = :priority
            WHERE id = :task_id
        ");
        return $stmt->execute([
            ':task_id' => $task_id,
            ':name' => $taskname,
            ':desc' => $taskdescription,
            ':due' => $taskDue,
            ':priority' => $taskPriority
        ]);
    }
}


?>