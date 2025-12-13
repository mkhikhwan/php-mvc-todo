<?php 
session_start();
$timeout_duration = 1800; // 30 Minutes of Session time

require_once 'app/core/Router.php';
require_once 'app/core/Database.php';
require_once 'app/core/routes.php';
require_once 'app/core/HTTPException.php';
require_once 'app/core/Controller.php';

try{
    if(
        isset($_SESSION['LAST_ACTIVITY']) && 
        (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration
    ){
        // Log user out after session expires
        session_unset();
        session_destroy();
        header("Location: /");
        exit();
    } 

    $_SESSION['LAST_ACTIVITY'] = time();
    $router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
}catch(HTTPException $e){
    $code = $e->getStatusCode();
    http_response_code($code);

    require_once __DIR__ . "/app/views/error/" . $code . ".php";
    exit;
}

?>