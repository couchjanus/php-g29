<?php
namespace App\Controllers\Admin;

use Core\{Response, Request, BaseController, Upload, Resizer};

use App\Models\Category;


class CategoryController extends BaseController
{
    use Upload, Resizer;

    protected static string $layout = 'admin';
    protected Response $response;

    private Category $category;

    public function __construct(protected Request $request)
    {
        $this->request = $request;
        parent::__construct($this->request);

        $this->response = $this->getResponse(static::$layout);
        $this->category = new Category();
    }


    public function index()
    {
        $categories = $this->category->select()->get();
        $this->response->render('admin/category/index', compact('categories'));
    }

    public function create()
    {
        $this->response->render('admin/category/create');
    }
    public function store()
    {
        $this->category->name = $this->request->name;
        $this->category->section_id = $this->request->section_id;
        
        $imgObj = $this->load($this->request->cover['tmp_name']);

        $this->category->cover = $this->save($imgObj, "/categories/", $imgObj->type, 75);
        unset($imgObj);

        if($this->category->save()) {
            $this->response->redirect('/admin/categories');
        } else {
            $this->response->redirect('/errors');
        }
    }

    public function edit($params)
    {
        extract($params);
        $category = $this->category->first($id);
        $this->response->render('admin/category/edit', compact('category'));
    }

    public function update()
    {
        $this->category->id = $this->request->id;
        $this->category->name = $this->request->name;
        $this->category->section_id = $this->request->section_id;

        if($this->category->save()) {
            $this->response->redirect('/admin/categories');
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
            if ($this->category->delete($this->request->id)) {
                $this->response->redirect('/admin/categories');
            } else {
                $this->response->redirect('/errors');
            }
        }

    }
}