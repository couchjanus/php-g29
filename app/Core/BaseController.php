<?php
namespace Core;

class BaseController extends Controller implements Interfaces\ResponseInterface
{
    public function getResponse(string $layout): Response 
    {
        return new Response($layout);
    }
}