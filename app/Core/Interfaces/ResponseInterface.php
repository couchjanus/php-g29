<?php
require_once ROOT.'/app/Core/Response.php';

interface ResponseInterface
{
    public function getResponse(string $layout): Response;
}