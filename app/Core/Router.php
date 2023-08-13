<?php
namespace Core;

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
            
            return $this->init(self::$routes[$this->request->get_uri()]);
        }else{
           
            echo  '<h1>404 - not found</h1>';
        }
    }

    private function init(string $path)
    {
        [$controller, $action] = explode('@', $path);
        $controller = "\\App\Controllers\\$controller";
        $controller = new $controller($this->request);
 
        if (method_exists($controller, $action)){
            return $controller->$action();
        }else {
            return $controller;
        }
    }
}