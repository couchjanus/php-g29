<?php
namespace Controllers\Admin;

use Core\{Response, Request, BaseController};

use Models\Brand;

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

    public function edit($params)
    {
       
        extract($params);
        
        $brand = $this->brand->first($id);
        $this->response->render('admin/brand/edit', compact('brand'));
       
    }

    public function update()
    {
        $this->brand->id = $this->request->id;
        $this->brand->name = $this->request->name;
        $this->brand->description = $this->request->description;

        if($this->brand->save()) {
            $this->response->redirect('/admin/brands');
        }else{
            $this->response->redirect('/errors');
        }

    }
    public function show()
    {

    }
    public function destroy($params)
    {
        extract($params);
        If($_POST) {
            if ($this->brand->delete($this->request->id)) {
                $this->response->redirect('/admin/brands');
            }else{
                $this->response->redirect('/errors');
            }
        }

    }

}