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
        // 1. grab the link defined in the router i.e 
        //    $router->get('/shownum/{num}', 'TestController@shownum');
        //    the link is '/shownum/{num}'
        foreach($this->routes[$method] as $path => $action){
            // 2. replace the '/shownum/{num}' to '/shownum/([a-zA-Z0-9_-]+)'
            $pattern = preg_replace("#\{[a-zA-Z0-9_]+\}#","([a-zA-Z0-9_-]+)", $path);

            // 3. Check if the url received matches the format of the defined url i.e
            //    URL Received : '/shownum/42'
            //    Compare URL Received == URL defined.
            //    If match, the regex will seperate the URL string with the capturing group to:
            //          [fullURL, Parameter]
            //    If not matched, it will do nothing and eventually return false;
            //    Read more on how Regex works to understand the str   ing.
            //    Extra : we use # as delimiter in the regex because we have / in our route string.
            if(preg_match("#^$pattern$#", $uri, $matches)){
                array_shift($matches);
                [$controller, $function] = explode('@',$action);
                return [$controller, $function, $matches];
            }
        }

        return false;
    }
}

?>