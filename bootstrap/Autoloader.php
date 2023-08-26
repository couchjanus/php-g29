<?php
class Autoloader
{
    public static function ClassLoader (string $class) {
        
        $fqcnToPath = fn(string $fqcn) => str_replace('\\', '/', $fqcn) . '.php';
        $path = $fqcnToPath($class);
        $filePath = ROOT  . '/app/' . $path;
        
        if(is_file($filePath) && is_readable($filePath)) {
            require_once $filePath;
        }
    }
}

spl_autoload_register('Autoloader::ClassLoader');
