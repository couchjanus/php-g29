<?php
namespace Controllers;

use Models\{Product, Category, User, Order};

use Core\{BaseController, Session, Request, Response};
use Core\Interfaces\AuthInterface;

class CartController extends BaseController implements AuthInterface
{
    protected static string $layout = 'app';
    protected $user;
    protected Order $order;
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
        $this->order = new Order();

    }

    public function auth(){

        if ($this->user) {
           echo json_encode($this->user->id);    
        } else {
            echo json_encode(false);    
        }
        
    }

    public function index(){

        $this->response->render('/home/cart');
    }

    public function isGranted(string $name = 'customer'):bool
    {
        if (!$this->user) {
            $this->response->redirect('/login');
        }
        return true;
    }

    public function checkout()
    {
        if (!$this->user) {
            $this->response->redirect("/login");
        }

        // Only allow POST requests
        if (strtoupper($_SERVER['REQUEST_METHOD']) != 'POST') {
            throw new \Exception('Only POST requests are allowed');
        }

        // Make sure Content-Type is application/json 
        $content_type = isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : '';
        if (stripos($content_type, 'application/json') === false) {
            throw new \Exception('Content-Type must be application/json');
        } else {
            // Read the input stream
            // Receive the RAW post data.
            $content = trim(file_get_contents("php://input"));

            // Decode the JSON object
            $decoded = json_decode($content, true);

            // Throw an exception if decoding failed
            if (!is_array($decoded)) {
                throw new \Exception('Failed to decode JSON object');
            }

            $productsInCart = json_encode($decoded['cart']);

            $this->order->user_id = $this->user->id;
            $this->order->products = $productsInCart;
        
            try {

                $sql = "INSERT INTO orders (user_id, products) VALUES (?, ?)";
                
                $result = $this->order->insert($sql, [$this->user->id, $productsInCart]) ;

                $options = array(
                    'error' => false,
                    'message' => 'Everything OK',
                    'result' => $result,
                );
                echo json_encode($options);
            } catch(\Exception $e){
                $options = array(
                    'error' => true,
                    'message' => $e->getMessage(),
                    'result' => $result,
                );
                echo json_encode($options);
            }
            
        }
    }

}