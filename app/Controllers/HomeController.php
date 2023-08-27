<?php
namespace Controllers;

use Core\{BaseController, Request, Response};
use Models\{User, Product, Category};

class HomeController extends BaseController
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
        $this->response->render('/home/index');
    } 

    public function getProducts()
    {
        $products = (new Product)->select(["products.*", "categories.name as category", "categories.id as categoryId", "brands.name as brand", "brands.id as brandId", "badges.title", "badges.type"])->injoin(['categories' => 'category_id', 'brands' => 'brand_id', 'badges' => 'badge_id'])->get();
        echo json_encode($products);
    }

    public function getCategories()
    {
        $categories = (new Category)->select(['categories.*', 'sections.name as section', 'sections.id as sectionId'])->injoin(['sections'=>'section_id'])->get();
        echo json_encode($categories);
    }
}

