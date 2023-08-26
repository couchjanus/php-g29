<?php
namespace Controllers;

use Core\{BaseController, Request, Response, Validator, Rule};
use Core\Traits\Helpers;
use Models\User;

class RegisterController extends BaseController
{
    use Helpers;

    protected static string $layout = 'app';
    protected Response $response;
    private User $user;

    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct($this->request);
        $this->response = $this->getResponse(static::$layout);
        $this->user = new User();
    }

    public function index()
    {
        $this->response->render('/auth/register');
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
}

