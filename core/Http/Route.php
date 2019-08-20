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
        $notiError = function () {
            echo '404';
        }
        //check url
        foreach (self::$urls as $url) {
            // check method
            if (strcmp($url['method'], 'get') == 0) {
                //check have params
                if ($url['have_params']) {
                    // check uri
                    $matching_uri = true;
                    $request_exploding = explode('/', $this->request->getUri());
                    $uri_exploding = explode('/', $url['uri']);
                    $uri_exploding_amount = count($uri_exploding);
                    $request_exploding_amount = count($request_exploding);
                    //  matching amount elements of each arrays
                    if ($request_exploding_amount == $uri_exploding_amount) {    
                        $different_indexes = [];    
                        for ($i = 0; $i < $uri_exploding_amount; $i++) {
                            if (strcmp($request_exploding[$i], $uri_exploding[$i]) !== 0) {
                                array_push($different_indexes, $i);
                            }
                        }
                        for ($j = 0, $i = 0; $i < $uri_exploding_amount - count($different_indexes); $i++, $j++) {
                            if ($i == 0) {
                                array_splice($request_exploding, $different_indexes[$i], 1);
                                array_splice($uri_exploding, $different_indexes[$i], 1);
                            } else {
                                array_splice($request_exploding, $different_indexes[$i]-$j, 1);    
                                array_splice($uri_exploding, $different_indexes[$i]-$j, 1); 
                            }
                        }
                        for ($i = 0; $i < count($uri_exploding); $i++) {
                            // matching order of each arrays
                            if (strcmp($request_exploding[$i], $uri_exploding[$i]) !== 0) {
                                return $matching_uri = false;
                            }
                        }
                        // true -> push params to self::url['params'] 
                        for ($i = 0; $i < count($different_indexes); $i++) {
                            array_push($url['params'], explode('/', $this->request->getUri())[$different_indexes[$i]]);
                        }   
                        // get controller and call action with params
                        if ($matching_uri) {
                            $action_controller = preg_split('/@/', $url['action']);
                            require __DIR__ . '/../../app/controllers/' . $action_controller[0] .'.php';
                            $controller_class = 'App\Controllers\\' . $action_controller[0];
                            $controller = new $controller_class();
                            call_user_func_array(array($controller, $action_controller[1]), $url['params']);
                        } else return call_user_func($notiError);   
                    } else return call_user_func($notiError);     
                }
            }
        }
    }

    static public function get ($uri, $action = [], $method = 'get') 
    {
        //have params
        if (preg_match_all('/(?<=\{).+?(?=\})/', $uri, $array)) {
            array_push(self::$urls, array('uri' => '/' . $uri,
                                       'method' => 'get',
                                  'have_params' => 1,
                                       'action' => $action,
                                       'params' => []));
        }
            
        //don't have params
        else {
            array_push(self::$urls, array('uri' => '/' . $uri,
                                       'method' => 'get',
                                  'have_params' => 0,
                                       'action' => $action,
                                       'params' => []));
        }
    }

    static public function view ($uri, $action = [], $type = 'view') 
    {
      
    }
}


