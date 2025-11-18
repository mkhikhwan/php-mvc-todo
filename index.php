<?php 
session_start();
require_once 'app/core/Router.php';
require_once 'app/core/Database.php';
require_once 'app/core/routes.php';

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

?>