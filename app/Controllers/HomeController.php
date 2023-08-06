<?php

// include_once realpath(ROOT."/app/Views/home/index.php");

// render('home/index');
require_once ROOT.'/app/Core/Response.php';

class HomeController
{
    protected static string $layout = 'app';
    protected Response $response;

    public function __construct()
    {
        // render('home/index');
        $this->response = new Response(static::$layout);
    }
    public function index()
    {
        // render('home/index');
        $this->response->render('home/index');
    }

}