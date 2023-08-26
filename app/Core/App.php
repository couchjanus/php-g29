<?php
namespace Core;

class App
{
    public function __construct(){
        Session::instance();
    }
    public function run(){
        $routes = ROOT.'/config/routes.php';
        (new Router($routes))->run();
    }
}
