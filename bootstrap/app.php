<?php

define('ROOT', dirname(__DIR__));

function get_uri()
{
    return trim($_SERVER['REQUEST_URI'], '/');
}

$uri = fn() =>  trim($_SERVER['REQUEST_URI'], '/');
$not_found = fn() => '<h1>404 - not found</h1>';

$get_controller = fn($controller) => include_once realpath(ROOT."/app/Controllers/$controller.php");


function conf($mix) {
    $url = ROOT."/config/{$mix}.json";
    $json = file_get_contents($url);
    return json_decode($json, True);
}

function render($view, $params=null)
{
    
    function view($view, $params)
    {
  
        ob_start();
        if ($params) {
            extract($params);
        }

        include_once realpath(ROOT."/app/Views/$view.php");
        return ob_get_clean();
    }

    ob_start();
    $content = view($view, $params);
    require_once realpath(ROOT."/app/Views/layouts/app.php");
    echo str_replace("{{ content }}", $content, ob_get_clean());
}

$route = match($uri()) {
    '' => $get_controller('HomeController'),
    'shop' => $get_controller('ShopController'),
    'about' => $get_controller('AboutController'),
    'contact' => $get_controller('ContactController'),
    default => $not_found(),
};
    

// echo $route;
