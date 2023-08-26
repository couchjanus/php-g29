<?php
namespace Controllers\Admin;

use Core\{Response, Request, BaseController};

use Models\Role;

class RoleController extends BaseController
{
    protected static string $layout = 'admin';
    protected Response $response;
    private Role $role;

    public function __construct(protected Request $request)
    {
        $this->request = $request;
        parent::__construct($this->request);

        $this->response = $this->getResponse(static::$layout);
        $this->role = new Role();
    }

    public function index()
    {
        $roles = $this->role->select()->get();
        
        $this->response->render('admin/role/index', ['roles' => $roles]);
    }

    public function create()
    {
        $this->response->render('admin/role/create');
    }
    public function store()
    {
        $this->role->name = $this->request->name;

        if($this->role->save()) {
            $this->response->redirect('/admin/roles');
        }else{
            $this->response->redirect('/errors');
        }

    }

    public function edit($params)
    {
       
        extract($params);
        
        $role = $this->role->first($id);
        $this->response->render('admin/role/edit', compact('role'));
       
    }

    public function update()
    {
        $this->role->id = $this->request->id;
        $this->role->name = $this->request->name;
        
        if($this->role->save()) {
            $this->response->redirect('/admin/roles');
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
            if ($this->role->delete($this->request->id)) {
                $this->response->redirect('/admin/roles');
            }else{
                $this->response->redirect('/errors');
            }
        }

    }

}