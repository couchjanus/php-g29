<?php

require_once ROOT.'/app/Core/BaseController.php';

class HomeController extends BaseController
{
    protected static string $layout = 'app';
    
    public function index()
    {
        $this->getResponse(static::$layout)->render('home/index');
    }

}