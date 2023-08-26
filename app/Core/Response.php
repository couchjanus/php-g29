<?php 
namespace Core;

class Response 
{

    // Constructor Property Promotion is a new syntax in PHP 8 that allows class property declaration and constructor assignment right from the constructor.

    // A typical class that declares a property, and then assigns a value to it in the class constructor is quite verbose.
    
    // public array $headers;

    private string $content;

    private string $statusText;

    private array $statusTexts = [
        200 => "All Ok",
        302 => "Resource Found",
        400 => "Bad Request",
        401 => "Unauttorized",
        403 => "Forbidden",
        404 => "Not Found",
        500 => "Internal Server Error"
    ];

    // With the Constructor Property Promotion syntax, the class declaration above can be minimized to avoid boilerplate:

    public function __construct(
        protected string $layout, 
        private int $status = 200, 
        public array $headers = [],
        private string $version = "1.0",
        private string $charset = "UTF-8",
    )
    {
        $this->status = $status;
        $this->statusText = $this->statusTexts[$this->status];
        $this->version = $version;
        $this->charset = $charset;
        $this->headers = $headers;
        $this->layout = $layout;

        ob_start();
        require_once VIEWS."/layouts/$this->layout.php";
        $this->content = ob_get_clean();
    }


    private function send()
    {
        $this->sendHeaders();
        $this->sendContent();
        $this->flushBuffer();
        return $this;
    }

    private function sendHeaders()
    {
        if (headers_sent()) {
            return $this;
        }
        header(sprintf('HTTP/%s %s %s', $this->version, $this->status, $this->statusText), true, $this->status);

        if(!array_key_exists('Content-Type', $this->headers)) {
            header('Content-Type: '. 'text/html; charset='.$this->charset);
        }

        foreach ($this->headers as $name => $value){
            header($name.': '.$value, true, $this->status);
        }
        return $this;
    }

    private function sendContent()
    {
        echo $this->content;
        return $this;
    }
    private function flushBuffer()
    {
        flush();
    }

    private function setContent(string $content="")
    {
        $this->content = $content;
        return $this;
    }

    public function render($view, $params=[])
    {
        foreach ($params as $key => $value){
            $$key = $value;
        }
 
        ob_start();
        include_once VIEWS."/$view.php";
        $content = ob_get_clean();
        $rendered = str_replace('{{ content }}', $content, $this->content);
        $this->setContent($rendered);
        $this->send();
    }

    public static function redirect($location="")
    {
        header('Location: http://'.$_SERVER['HTTP_HOST'].$location);
        exit();
    }

    public static function back($location = ""){
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}