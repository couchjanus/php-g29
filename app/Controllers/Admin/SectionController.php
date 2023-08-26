<?php
namespace Controllers\Admin;

use Core\{Response, Request, BaseController};

use Models\Section;

class SectionController extends BaseController
{
    protected static string $layout = 'admin';
    protected Response $response;
    private Section $section;

    public function __construct(protected Request $request)
    {
        $this->request = $request;
        parent::__construct($this->request);

        $this->response = $this->getResponse(static::$layout);
        $this->section = new Section();
    }

    public function index()
    {
        $sections = $this->section->select()->get();
        
        $this->response->render('admin/section/index', ['sections' => $sections]);
    }

    public function create()
    {
        $this->response->render('admin/section/create');
    }
    public function store()
    {
        $this->section->name = $this->request->name;
    

        if($this->section->save()) {
            $this->response->redirect('/admin/sections');
        }else{
            $this->response->redirect('/errors');
        }

    }

    public function edit($params)
    {
       
        extract($params);
        
        $section = $this->section->first($id);
        $this->response->render('admin/section/edit', compact('section'));
       
    }

    public function update()
    {
        $this->section->id = $this->request->id;
        $this->section->name = $this->request->name;
        

        if($this->section->save()) {
            $this->response->redirect('/admin/sections');
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
            if ($this->section->delete($this->request->id)) {
                $this->response->redirect('/admin/sections');
            }else{
                $this->response->redirect('/errors');
            }
        }

    }

}