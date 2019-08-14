<?php
namespace Core\Http;

require_once __DIR__ . '/../../app/route.php';

use Core\Http\Request;

class Route 
{
    private static $uri = [];
    private static $singletonRoute;
    private $request;
    private function __construct () {

    }

    public static function instantiate () {
        if (self::$singletonRoute == null) {
            self::$singletonRoute = new Route();
        }
        return self::$singletonRoute;
    }

    public function getRequest ($request) {
        $this->request = $request;
    }

    public function showView () {
        $uri = $this->request->getUri();
        $view_file = function () {
            echo 'this is view';
        };
        $error_view_file = function () {
            echo '404';
        };
        foreach (self::$uri as $key => $value) {
            if (strcmp($key, $uri) == 0) {
                return call_user_func($view_file);
            }
        }
        return call_user_func($error_view_file);
    }

    static public function get ($uri, $action = null) {
        self::$uri['/' . $uri] = $action;
    }
}

