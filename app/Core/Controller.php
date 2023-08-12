<?php

require_once ROOT.'/app/Core/Request.php';

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
