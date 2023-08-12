<?php
require_once ROOT.'/app/Core/Response.php';
require_once ROOT.'/app/Core/Request.php';
require_once ROOT.'/app/Core/BaseController.php';
require_once ROOT. '/app/Models/Brand.php';

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
        $brands = $this->brand->get();
        $this->response->render('admin/brand/index', ['brands' => $brands]);
    }

    public function create()
    {
        $this->getResponse(static::$layout)->render('admin/brand/create');
    }
    public function store()
    {

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