<?php
require_once ROOT.'/app/Core/Controller.php';
require_once ROOT.'/app/Core/Response.php';
require_once ROOT.'/app/Core/Interfaces/ResponseInterface.php';

class BaseController extends Controller implements ResponseInterface
{

    public function getResponse(string $layout): Response 
    {
        return new Response($layout);
    }
}