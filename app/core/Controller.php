<?php

class Controller{
    protected function view($viewPath, $data = []){
        extract($data, EXTR_SKIP);
        require_once __DIR__ . '/../views/layouts/main.php';
    }

    protected function redirect($url){
        header("Location: $url");
        exit;
    }

    protected function requireLogin(){
        if(!isset($_SESSION['user_id'])){
            $this->redirect("/login");
        }
    }
}

?>
