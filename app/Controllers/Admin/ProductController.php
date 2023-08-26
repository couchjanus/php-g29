<?php
namespace Controllers\Admin;

use Core\{Response, Request, BaseController, Upload, Resizer};

use Models\{Product, Brand, Badge, Category};


class ProductController extends BaseController
{
    use Upload, Resizer;

    protected static string $layout = 'admin';
    protected Response $response;

    private Product $product;

    public function __construct(protected Request $request)
    {
        $this->request = $request;
        parent::__construct($this->request);

        $this->response = $this->getResponse(static::$layout);
        $this->product = new Product();
    }


    public function index()
    {
        $products = $this->product->select()->get();
        $this->response->render('admin/product/index', compact('products'));
    }

    public function create()
    {
        $categories = (new Category())->select()->get();
        $badges = (new Badge())->select()->get();
        $brands = (new Brand())->select()->get();
        $this->response->render('admin/product/create', ['categories'=> $categories, 'badges' => $badges, 'brands' => $brands]);
    }
    public function store()
    {
        // var_dump($this->request);
        // exit();
        $this->product->name = $this->request->name;
        $this->product->price = $this->request->price;
        $this->product->description = $this->request->description;
        $this->product->category_id = $this->request->category_id;
        $this->product->brand_id = $this->request->brand_id;
        $this->product->badge_id = $this->request->badge_id;
        $this->product->status = $this->request->status? 1 : 0;
        
        $imgObj = $this->load($this->request->image['tmp_name']);
        $image = $this->resize_width(300, $imgObj);
        $this->product->image = $this->save($image, "/products/", $imgObj->type, 75);
        unset($imgObj);

        if($this->product->save()) {
            $this->response->redirect('/admin/products');
        } else {
            $this->response->redirect('/errors');
        }
    }

    public function edit($params)
    {
        extract($params);
        $product = $this->product->first($id);
        $this->response->render('admin/product/edit', compact('product'));
    }

    public function update()
    {
        $this->product->id = $this->request->id;
        $this->product->name = $this->request->name;
        $this->product->category_id = $this->request->category_id;

        if($this->product->save()) {
            $this->response->redirect('/admin/products');
        } else {
            $this->response->redirect('/errors');
        }

    }
    public function show()
    {

    }
    public function destroy($params)
    {
        extract($params);
        if($_POST) {
            if ($this->product->delete($this->request->id)) {
                $this->response->redirect('/admin/products');
            } else {
                $this->response->redirect('/errors');
            }
        }

    }
}