<?php 
namespace Core\Http;

class Request 
{ 
    private $uri; 
    private $method;
    private $action;
    static private $singletonRequest;

    private function __construct () {
        
    }

    public static function instantiate() {
        if (self::$singletonRequest == null) {
            self::$singletonRequest = new Request();
        }
        return self::$singletonRequest;
    }

    public function getAttribute () {
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->action;
    }
    
    public function getUri () {
        return $this->uri;
    }
}

