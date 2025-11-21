<?php

require_once __DIR__ . "/../core/Controller.php";

class TaskController extends Controller{
    public function index(){
        $this->view('tasks/index');
    }
}

?>