<?php
namespace App\Controllers\Admin;

use Core\{Response, Request, BaseController};

use App\Models\Brand;

class BrandController extends BaseController
{
    protected static string $layout = 'admin';
    protected Response $response;
    private Brand $brand;

    public function __construct(protected Request $request)
    {
        $this->request = $request;
        parent::__construct($this->request);

        $this->response = $this->getResponse(static::$layout);
        $this->brand = new Brand();
    }

    public function index()
    {
        $brands = $this->brand->select()->get();
        // var_dump($brands);
        // exit();
        $this->response->render('admin/brand/index', ['brands' => $brands]);
    }

    public function create()
    {
        $this->response->render('admin/brand/create');
    }
    public function store()
    {
        $this->brand->name = $this->request->name;
        $this->brand->description = $this->request->description;

        if($this->brand->save()) {
            $this->response->redirect('/admin/brands');
        }else{
            $this->response->redirect('/errors');
        }

    }

    public function edit()
    {
        $this->getResponse(static::$layout)->render('admin/brand/edit');
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