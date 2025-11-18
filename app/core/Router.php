<?php 

class Router{
    private $routes = [
        'GET' => [],
        'POST' => []
    ];

    public function get($path, $action){
        $this->routes['GET'][$path] = $action;
    }

    public function post($path, $action){
        $this->routes['POST'][$path] = $action;
    }

    public function dispatch($method, $url){
        $parsed_url = parse_url($url, PHP_URL_PATH);
        $action = $this->matchRoute($method, $parsed_url);

        if(!$action){
            http_response_code(404);
            echo "404 Not Found";
            return;
        }

        [$controllerName, $methodName, $params] = $action;

        require_once "app/controllers/$controllerName.php";
        $controller = new $controllerName();
        call_user_func_array([$controller, $methodName], $params);
    }

    public function matchRoute($method, $uri){
        foreach ($this->routes[$method] as $route => $action) {
            $pattern = preg_replace('#\{[a-zA-Z0-9_]+\}#', '([a-zA-Z0-9_-]+)', $route);
            if (preg_match("#^$pattern$#", $uri, $matches)) {
                array_shift($matches);
                [$controller, $method] = explode('@', $action);
                return [$controller, $method, $matches];
            }
        }
        return false;
    }
}

?>