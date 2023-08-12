<?php

class Response
{
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

    public function __construct(
        protected string $layout,
        private int $status = 200,
        public array $headers = [],
        private string $version = "1.0",
        private string $charset = "UTF-8"
    )
    {
        $this->layout = $layout;
        $this->status = $status;
        $this->headers = $headers;
        $this->version = $version;
        $this->charset = $charset;
        $this->statusText = $this->statusTexts[$this->status];

        ob_start();
        require_once ROOT."/app/Views/layouts/$this->layout.php";
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
        if(!array_key_exists('Content-Type', $this->headers)){
            header('Content-Type: '. 'text/html; charset='.$this->charset);
        }
        
        foreach($this->headers as $k => $v) {
            header($k.': '.$v, true, $this->status);
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
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once ROOT."/app/Views/$view.php";
        $content = ob_get_clean();
        
        $rendered= str_replace("{{ content }}", $content, $this->content);
        // echo $rendered;
        $this->setContent($rendered);
        $this->send();
    }
}