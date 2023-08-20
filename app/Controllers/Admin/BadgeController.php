<?php
namespace App\Controllers\Admin;

use Core\{Response, Request, BaseController};

use App\Models\Badge;

class BadgeController extends BaseController
{
    protected static string $layout = 'admin';
    protected Response $response;
    private Badge $badge;

    public function __construct(protected Request $request)
    {
        $this->request = $request;
        parent::__construct($this->request);

        $this->response = $this->getResponse(static::$layout);
        $this->badge = new Badge();
    }

    public function index()
    {
        $badges = $this->badge->select()->get();
        
        $this->response->render('admin/badge/index', ['badges' => $badges]);
    }

    public function create()
    {
        $this->response->render('admin/badge/create');
    }
    public function store()
    {
        $this->badge->title = $this->request->title;
        $this->badge->type = $this->request->type;

        if($this->badge->save()) {
            $this->response->redirect('/admin/badges');
        }else{
            $this->response->redirect('/errors');
        }

    }

    public function edit($params)
    {
       
        extract($params);
        
        $badge = $this->badge->first($id);
        $this->response->render('admin/badge/edit', compact('badge'));
       
    }

    public function update()
    {
        $this->badge->id = $this->request->id;
        $this->badge->title = $this->request->title;
        $this->badge->type = $this->request->type;

        if($this->badge->save()) {
            $this->response->redirect('/admin/badges');
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
            if ($this->badge->delete($this->request->id)) {
                $this->response->redirect('/admin/badges');
            }else{
                $this->response->redirect('/errors');
            }
        }

    }

}