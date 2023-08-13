<?php
namespace Core\Interfaces;

use Core\Response;

interface ResponseInterface
{
    public function getResponse(string $layout): Response;
}