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

    
    public function run()    {
    if(array_key_exists($this->request->get_uri(), self::$routes)) {
        return $this->init(self::$routes[$this->request->get_uri()]);
    } else {
       
        foreach (self::$routes as $key => $value) {
            $pattern = "%^" . preg_replace('/{([a-zA-Z0-9]+)}/', '(?<$1>[0-9]+)', $key) . "$%";
            preg_match($pattern, $this->request->get_uri(), $matches);
            array_shift($matches);
            if ($matches) {
                $arr[] = $value;
                $arr[] = $matches;
                return $this->init(...$arr);
            }
        }
    }

}

    private function init(string $path, $vars=[])
    {
        [$controller, $action] = explode('@', $path);
        $controller = "\\App\Controllers\\$controller";
        $controller = new $controller($this->request);
 
        if (method_exists($controller, $action)){
            return $controller->$action($vars);
        }else {
            return $controller;
        }
    }
}