<?php

define('ROOT', dirname(__DIR__));

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
const DB_CONFIG_FILE = ROOT.'/config/db.php';
const MEDIA = '/storage';
define("STORAGE", $_SERVER['DOCUMENT_ROOT'].MEDIA);

require_once __DIR__.'/Autoloader.php';
// require_once ROOT.'/app/Core/Router.php';
$router = new Core\Router();
$router->run();