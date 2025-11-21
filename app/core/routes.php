<?php

$router = new Router();


$router->get('/test', 'TestController@test');
$router->get('/name', 'TestController@name');
$router->get("/shownum/{num}", 'TestController@shownum');

$router->get('/', 'HomeController@landingPage');
$router->get('/register', 'AuthController@register');
$router->post('/register', 'AuthController@doRegister');

$router->get('/login', 'AuthController@login');
$router->post('/login', 'AuthController@doLogin');
$router->get('/logout', 'AuthController@logout');

$router->get('/tasks', 'TaskController@index');



?>