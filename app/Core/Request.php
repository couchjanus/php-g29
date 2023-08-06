<?php

class Request 
{
    public function get_uri()
    {
        return trim($_SERVER['REQUEST_URI'], '/');
    }
}