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
            'message' => $_SESSION['flash_message'] ?? [],
            'tasks' => $tasks
        ]);
        unset($_SESSION['flash_message']);
    }

    public function viewTask($taskId){
        $task = $this->taskModel->viewTask($taskId);
        $this->view('tasks/viewTask', [
            'task' => $task
        ]);
    }

    public function addTask(){
        $this->view('tasks/addTask');
    }

    public function doAddTask(){
        $user_id = $_SESSION['user_id'];
        $taskName = $_POST["task-name"];
        $taskDescription = $_POST["task-description"];
        $taskDue = $_POST["task-due"];
        $taskPriority = $_POST["task-priority"];

        $ok = $this->taskModel->create($user_id, $taskName, $taskDescription, $taskDue, $taskPriority);

        if($ok){
            $_SESSION['flash_message'] = ['success' => 'Add Task Successfully.'];
            $this->redirect("/tasks");
        }
    }

    public function deleteTask(){
        $taskId = $_POST['id'];

        if(!isset($taskId)){
            $_SESSION['flash_message'] = ['error' => "There's soemthing wrong with performing the action. Please try again."];
            $this->redirect("/tasks");
        }

        $ok = $this->taskModel->deleteTask($taskId);
        if($ok){
            $_SESSION['flash_message'] = ['success' => 'Task deleted successfully'];
            $this->redirect("/tasks");
        }
    }

    public function setTaskDone(){
        $taskId = $_POST['id'];
        $isDone = filter_var($_POST['isDone'], FILTER_VALIDATE_BOOLEAN);

        if(!isset($taskId)){
            $_SESSION['flash_message'] = ['error' => "There's soemthing wrong with performing the action. Please try again."];
            $this->redirect("/tasks");
        }

        $ok = $this->taskModel->setTaskDone($taskId, $isDone);
        if($ok){
            $this->redirect("/tasks");
        }
    }

    public function editTask($taskId){
        $task = $this->taskModel->viewTask($taskId);
        $this->view('tasks/editTask', [
            'priority' => ['low', 'medium', 'high'],
            'task' => $task
        ]);
    }

    public function doEditTask($taskId){
        $user_id = $_SESSION['user_id'];
        $taskName = $_POST["task-name"];
        $taskDescription = $_POST["task-description"];
        $taskDue = $_POST["task-due"];
        $taskPriority = $_POST["task-priority"];

        $ok = $this->taskModel->editTask($taskId, $taskName, $taskDescription, $taskDue, $taskPriority);
        if($ok){
            $_SESSION['flash_message'] = ['success' => 'Edit Task Successful.'];
            $this->redirect("/tasks");
        }
    }
}

?>