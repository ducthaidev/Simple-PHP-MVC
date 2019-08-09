<?php

/*
 * put the namespace prefix and src 
 * to $classes_autoload array
 * like $classes_autoload('\\abc\\xyz\\' => '/src');
 */

$classes_autoload = array(     
    'App\\' => '/app',
    'Core\\' => '/core'
);

class Autoload 
{
    private $classes_autoload = [];
    private $path;
    private static $singletonObject;

    private function __construct ($classes_autoload) {
        $this->classes_autoload = $classes_autoload;
    }

    public static function instantiate ($classes_autoload) {
        if (self::$singletonObject == null) {
        self::$singletonObject = new Autoload($classes_autoload);
        }
        return self::$singletonObject;
    }

    public function isPSR_4 ($class) {
        foreach ($this->classes_autoload as $prefix => $src) {
            if (substr($class, 0, strlen($prefix)) === $prefix) {
                $this->path = __DIR__ . $src . '/' . substr($class, strlen($prefix)) . '.php';
                
                return true;
            }
        }
        return false;
    }
    
    public function run ($class) {
        if ($this->isPSR_4($class) == true) {
            if (file_exists ($this->path)) {
                require $this->path;
            }
        }
    }
}
$autoload = Autoload::instantiate($classes_autoload);

spl_autoload_register(function ($class) use ($autoload) {
    $autoload->run($class);
});