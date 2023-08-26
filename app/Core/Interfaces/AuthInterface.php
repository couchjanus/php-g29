<?php

namespace Core\Interfaces;

interface AuthInterface
{
    public function isGranted(string $role):bool;
}