<?php

require_once ROOT.'/app/Core/Request.php';

class Router
{
    private Request $request;

    private static array $routes;

    public function __construct(string $routes = ROOT.'/config/routes.php')
    {
        $this->request = new Request();
        self::$routes = require_once $routes;
    }

    public function run()
    {
        if(array_key_exists($this->request->get_uri(), self::$routes)){
            // echo self::$routes[$this->request->get_uri()];
            return $this->init(self::$routes[$this->request->get_uri()]);
        }else{
            // var_dump($this->request->get_uri());
            echo  '<h1>404 - not found</h1>';
        }
    }

    private function init(string $path)
    {
        $segments = explode('/', $path);
        // $controller = array_pop($segments);
        $segment = array_pop($segments);
        [$controller, $action] = explode('@', $segment);
        $controllerPath = array_pop($segments);
        $controllerPath = $controllerPath ? '/'.$controllerPath: '';

        $controllerPath = ROOT.'/app/Controllers/'.$controllerPath.'/'.$controller.'.php';
        if (file_exists($controllerPath)){
            include_once $controllerPath;
            $controller = new $controller($this->request);
        }else{
            throw new Exception("File $controllerPath does not exists!");
        }
       if (method_exists($controller, $action)){
            return $controller->$action();
       }else {
            return $controller;
       }
        
    }
}