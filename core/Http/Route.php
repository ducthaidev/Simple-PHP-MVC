<?php
namespace Core\Http; 

require_once __DIR__ . '/../../app/route.php';

class Route 
{
    // uri-> method-> have param? 1,0-> action -> params
    private static $urls = [];
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
        foreach (self::$urls as $url) {
            if (strcmp($url['method'], 'get') == 0) {
                if ($url['have_params']) {
                    $request_exploding = explode('/', $this->request->getUri());
                    $uri_exploding = explode('/', $url['uri']);
                    for ($i = 0; $i < count($uri_exploding); $i++) {
                        if (strcmp($request_exploding[$i], $uri_exploding[$i]) !== 0) {
                            $url['params'][$i] = $request_exploding[$i];
                        }
                    }
                }
            }
        }
    }

    static public function get ($uri, $action = null, $method = 'get') 
    {
        //have params
        if (preg_match_all('/(?<=\{).+?(?=\})/', $uri, $array)) {
            array_push(self::$urls, array('uri' => '/' . $uri,
                                       'method' => 'get',
                                  'have_params' => 1,
                                       'action' => $action,
                                       'params' => null));
        }
            
        //don't have params
        else {
            array_push(self::$urls, array('uri' => '/' . $uri,
                                       'method' => 'get',
                                  'have_params' => 0,
                                       'action' => $action,
                                       'params' => null));
        }
    }

    static public function view ($uri, $action = null, $type = 'view') 
    {
      
    }
}


