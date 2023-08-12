<?php
require_once ROOT.'/app/Core/Response.php';

class CategoryController 
{
    protected static string $layout = 'admin';
    protected Response $response;

    public function __construct()
    {
        $this->response = new Response(static::$layout);
    }
    public function index()
    {
        $this->response->render('admin/category/index');
    }

    public function create()
    {
        $this->response->render('admin/category/create');
    }
    public function store()
    {

    }

    public function edit()
    {
        $this->response->render('admin/category/edit');
    }

    public function update()
    {

    }
    public function show()
    {

    }
    public function delete()
    {

    }

}