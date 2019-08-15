<?php
namespace Core\Http; 
require_once __DIR__ . '/../../app/route.php';

use Core\Http\Request;

class Route 
{
    private static $uri = [];
    private static $singletonRoute;
    private $request;
    private function __construct () 
    {

    }

    public static function instantiate () 
    {
        if (self::$singletonRoute == null) {
            self::$singletonRoute = new Route();
        }
        return self::$singletonRoute;
    }

    public function getRequest ($request) 
    {
        $this->request = $request;
    }

    public function show () 
    {
        $uri = $this->request->getUri();
        $view_file = function () {
            
        };
        $error_view_file = function () {
            echo '404';
        };
        var_dump(self::$uri);
        foreach (self::$uri as $key => $value) {
            if (strcmp($key, $uri) == 0) {         
                foreach ($value as $s_key => $s_value) {
                    if (empty($s_value) == false) {
                        if (is_callable($s_value)) {
                            return call_user_func($s_value);
                        }
                    }
                }   
                
                // else return $view_file;
            }
        }
        return call_user_func($error_view_file);
    }

    static public function get ($uri, $action = null, $type = 'get') 
    {
        self::$uri['/' . $uri] = array($type => $action);
    }

    static public function view ($uri, $action = null, $type = 'view') 
    {
        self::$uri['/' . $uri] = array($type => $action);
        // require __DIR__ . '/../../app/views/' . $view_name . '.php';
    }
}


