<?php 
namespace Core;


class BaseController extends Controller implements Interfaces\makeResponse
{
    /**
     * @var Response
     */

    public function getResponse(string $layout) : Response
    {
        return new Response($layout);
    }
}