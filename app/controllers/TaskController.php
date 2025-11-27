<?php

require_once __DIR__ . "/../core/Controller.php";
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . "/../models/Task.php";

class TaskController extends Controller{
    private $taskModel;

    public function __construct(){
        $dbInstance = Database::getInstance();
        $this->taskModel = new Task($dbInstance);
    }
    
    public function index(){
        $this->requireLogin();
        
        $tasks = $this->taskModel->getAllTasks($_SESSION['user_id']);
        $this->view('tasks/index', [
            'tasks' => $tasks
        ]);
    }
}

?>