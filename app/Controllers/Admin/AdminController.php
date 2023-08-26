<?php
namespace Controllers\Admin;

use Core\Interfaces\AuthInterface;
use Core\{BaseController, Session, Request, Response};
use Models\{User, Role};

class AdminController extends BaseController implements AuthInterface {
    protected $user;
    protected static string $layout = 'admin';
    protected Response $response;

    public function __construct(Request $request){
        $this->request = $request;
        parent::__construct($this->request);
        $this->response = $this->getResponse(static::$layout);
        $userId = Session::instance()->get('userId');
        if($userId) {
            $this->user = (new User)->first($userId);
            if (!$this->isGranted("admin")) {
                $this->response->redirect("/profile");
            }
        } else {
            $this->response->redirect("/login");
        }
    }
    public function role() {
        if($this->user){
            $role = (new Role)->first($this->user->role_id); 
            return $role->name;
        }
    }
    public function isGranted(string $name):bool    {
        return ($this->role() === $name) ?? false;
    }
}
