<?php
// class a 
// {
//     private $x;
//     private static $d;
//     public function b () {
//        $a = 'haha'; 
//     }
// }

// $a = array('a'.'b' => '1321234a');
// var_dump($a);
// $b = '12a';
$a = function () {
    print 'trueeeeeeeeeeeeeeeeeeeeeeeee';
};
function b($a = null) {
    for ( $i = 0; $i < 10; $i++) {
        return call_user_func($a);
    }
    return print 'falseeeeeeeeeeeeeeeeeeee';
}
b($a);