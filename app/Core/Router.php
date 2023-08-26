<?php
namespace Core;

class Router 
{
    private Request $request;
    private static array $routes;

    public function __construct(string $routesPath = ROOT.'/config/routes.php')
    {
        $this->request = new Request();
        self::$routes = require_once $routesPath;
    }

    public function run()
    {
        if(array_key_exists($this->request->uri(), self::$routes)) {
            return $this->init(self::$routes[$this->request->uri()]);
        }else {
            foreach (self::$routes as $key => $value) {
                $pattern = "%^" . preg_replace('/{([a-zA-Z0-9]+)}/', '(?<$1>[0-9]+)', $key) . "$%";
                preg_match($pattern, $this->request->uri(), $matches);
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
        $controller = new $controller($this->request);
        return $controller->$action($vars);
    }
}

