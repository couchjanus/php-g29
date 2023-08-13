<?php

class Autoloader
{
    public static function ClassLoader(string $className)
    {
        $part = explode('\\', $className);

        $classDirs = [
            '/app/Core/',
            '/app/Core/Interfaces/',
            '/app/Models/',
            '/app/Controllers/',
            '/app/Controllers/Admin/',
        ];

        foreach ($classDirs as $classDir) {
            $filePath = ROOT.$classDir.end($part).'.php';

            if(is_file($filePath) && is_readable($filePath)) {
                require_once $filePath;
            }
        }
    }
}

spl_autoload_register('Autoloader::ClassLoader');