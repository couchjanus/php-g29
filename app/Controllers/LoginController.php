<?php
namespace Controllers;

use Core\{BaseController, Request, Response, Validator, Rule, Session};
use Core\Traits\Helpers;
use Models\User;

class LoginController extends BaseController
{
    use Helpers;

    protected static string $layout = 'app';
    protected Response $response;
    private User $user;
    public $isAuth = false;

    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct($this->request);
        $this->response = $this->getResponse(static::$layout);
        $this->user = new User();
        $this->isAuth = $this->isLogged();
    }

    protected function isLogged()
    {
        if (Session::instance()->get('userId')) {
            return true;
        }
        return false;
    }

    public function index()
    {
        if ($this->isAuth) {
            $this->response->redirect('/profile');
        } else {
            $this->response->render('auth/login');
        }
        
    } 

    protected function getUser(string $email)    {
        return $this->user->findBy("email='$email'");
    }

    function signin()    {
        $user = $this->getUser($this->request->email); 
        if ($user) {
            if (password_verify($this->request->password, $user->password)) {
                $this->isAuth = true;
                Session::instance()->set('userId', $user->id);
            }
        } else {
            $this->request->flash()->danger('Email address or password are incorrect.');
            $this->response->redirect('/login');
        }
        $this->response->redirect("/profile");
    }



    private function checkEmail(string $email) 
    {
        $condition = "email='$email'";
        return $this->user->findBy($condition) ? true : false;
    }

    private function firstError($errors)
    {
        $errors = array_pop($errors);
        return implode(array_values($errors));
    }


    public function signup()
    {
        if ($this->checkEmail($this->request->email)) {
            $this->response->redirect('/login');
        }

        $validator = new Validator(['email'=>$this->request->email, 'password' => $this->request->password]);

        $validator->addRule((new Rule('email'))->required()->email());
        $validator->addRule((new Rule('password'))->required()->password($this->request->confirmpassword));

        if (!$validator->check()) {
            if ($validator->getErrors('email')) {
                $this->request->flash()->danger($this->firstError($validator->getErrors('email')));
            } elseif ($validator->getErrors('password')) {
                $this->request->flash()->danger($this->firstError($validator->getErrors('password')));
            }
            $this->response->back();
        } else {

            $username = explode("@", $this->request->email)[0];
            $this->user->name = $username;
            $this->user->email = $this->request->email;
            $this->user->role_id = 2;
            $this->user->password = $this->getHash($this->request->password, 10);

            $this->user->first_name = $this->request->first_name ?? $username;
            $this->user->last_name = $this->request->last_name ?? '';
            $this->user->phone_number = $this->request->phone_number ?? '';


            try {
                $this->user->save();
                $this->request->flash()->success("Your profile created successfully");
                $this->response->redirect('/login');
            }catch(\Exception $e) {
                $this->request->flash()->danger($e->getMessage());
                $this->response->back();

            }

        }

    }

    public function logout():bool    
    {
        $this->isAuth = false;
        Session::instance()->unset('userId');
        $this->response->redirect('/');    
    }

}
