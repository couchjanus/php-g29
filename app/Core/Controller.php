<?php 
namespace Core;

abstract class Controller
{
    /**
     * @var Request
     */
    public function __construct(protected Request $request )
    {
        $this->request = $request ?? new Request();
    }
}