<?php
namespace Controllers;

use Core\Interfaces\AuthInterface;
use Core\{BaseController, Session, Request, Response};

use Models\{User, Order};

class ProfileController extends BaseController implements AuthInterface
{

    protected static string $layout = 'app';    

    protected $user;

    protected Response $response;

    public function __construct(Request $request){
        $this->request = $request;
        parent::__construct($this->request);

        $this->response = $this->getResponse(static::$layout);

        $userId = Session::instance()->get('userId');

        if($userId) {
            $this->user = (new User)->first($userId);
        } 

        $this->isGranted();
    }


    public function isGranted(string $name = 'customer'):bool
    {
        if (!$this->user) {
            $this->response->redirect('/login');
        }
        return true;
    }

    public function index()
    {
        $this->response->render('profile/index', ['user' => $this->user]);
    }


    public function orders()
    {
        $uid = $this->user->id;
        $orders = (new Order)->select()->where("user_id='$uid'")->get();
        $this->response->render('profile/orders', ['user' => $this->user, 'orders'=>$orders]);
    }

}