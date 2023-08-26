<?php
namespace Controllers\Admin;

use Core\{Response, Request, BaseController};

use Models\{Role, User};

class UserController extends BaseController
{
    protected static string $layout = 'admin';
    protected Response $response;
    private User $user;

    public function __construct(protected Request $request)
    {
        $this->request = $request;
        parent::__construct($this->request);

        $this->response = $this->getResponse(static::$layout);
        $this->user = new User();
    }

    public function index()
    {
        $users = $this->user->select()->get();
        
        $this->response->render('admin/user/index', ['users' => $users]);
    }

    public function create()
    {
        $this->response->render('admin/user/create');
    }
    public function store()
    {
        $this->user->name = $this->request->name;

        if($this->user->save()) {
            $this->response->redirect('/admin/users');
        }else{
            $this->response->redirect('/errors');
        }

    }

    public function edit($params)
    {
       
        extract($params);
        
        $user = $this->user->first($id);
        $roles = (new Role)->select()->get();

        $this->response->render('admin/user/edit', compact('roles', 'user'));
       
    }

    public function update()
    {
        $this->user->id = $this->request->id;
        $this->user->name = $this->request->name;
        $this->user->email = $this->request->email;
        $this->user->role_id = $this->request->role_id;
        $this->user->status = $this->request->status ? 1:0;

        try {
            $this->user->save();
            $this->request->flash()->success("User updated successfully!");
            $this->response->redirect('/admin/users');
            
        }catch(\Exception $e) {
            $this->request->flash()->danger($e->getMessage());
            $this->response->back();
        }

    }
    public function show()
    {

    }
    public function destroy($params)
    {
        extract($params);
        If($_POST) {
            if ($this->user->delete($this->request->id)) {
                $this->response->redirect('/admin/users');
            }else{
                $this->response->redirect('/errors');
            }
        }

    }

}