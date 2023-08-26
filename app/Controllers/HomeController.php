<?php
namespace Controllers;

use Core\BaseController;

class HomeController extends BaseController
{
    protected static string $layout = 'app';

    public function index()
    {
        $this->getResponse(static::$layout)->render('/home/index');
    } 
}

