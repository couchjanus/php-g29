<?php
namespace Core;

abstract class Controller
{
    /**
     * Constructor function
     *
     * @param Request $request
     */
    public function __construct(protected Request $request) 
    {
        $this->request = $request ?? new Request();
    }
}
