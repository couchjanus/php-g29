<?php
require_once ROOT.'/app/Core/Response.php';

class DashboardController
{
    protected static string $layout = 'admin';
    protected Response $response;

    public function __construct()
    {
        $this->response = new Response(static::$layout);
    }
    public function index()
    {

        $this->response->render('admin/index');
    }
}
