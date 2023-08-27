<?php
namespace Controllers;

use Core\{BaseController, Request, Response};
// use Models\{User, Product};

class ShopController extends BaseController
{
    protected static string $layout = 'app';
    
    protected Response $response;

    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct($this->request);

        $this->response = $this->getResponse(static::$layout);
    }

    public function index()
    {
        $this->response->render('/shop/index');
    } 

   
}

