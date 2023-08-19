<?php
namespace Core;

class Request 
{
    private array $request;

    public function __construct()
    {
        $this->request = $this->prepare($_REQUEST, $_FILES);
    }
    public function __get($name)
    {
        if (isset($this->request[$name])) {
            return $this->request[$name];
        }
    }

    private function prepare(array $request, array $files) {
        $request = $this->clean($request);
        return array_merge($files, $request);
    }

    private function clean($data) {
        if (is_array($data)) {
            $cleaned = [];
            foreach ($data as $key => $value) {
                $cleaned[$key] = $this->clean($value);
            }
            return $cleaned;
        }
        return trim(htmlspecialchars($data, ENT_QUOTES));
    }

    public function get_uri()
    {
        return trim($_SERVER['REQUEST_URI'], '/');
    }
}