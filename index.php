<?php 
session_start();
require_once 'app/core/Router.php';
require_once 'app/core/Database.php';
require_once 'app/core/routes.php';
require_once 'app/core/HTTPException.php';
require_once 'app/core/Controller.php';

try{
    $router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
}catch(HTTPException $e){
    $code = $e->getStatusCode();
    http_response_code($code);

    require_once __DIR__ . "/app/views/error/" . $code . ".php";
    exit;
}

?>