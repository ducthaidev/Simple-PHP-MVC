<?php
// class a 
// {
//     private $x;
//     private static $d;
//     public function b () {
//        $a = 'haha'; 
//     }
// }

$clo = function () {
    print 'helauuuuuuuuuuuuuuuu';
};
$course;
$course['frontend'] = array(
    'title' => $clo,
    'fee' => 1200000
);
foreach($course as $k => $v){
    var_dump($v);
    // print $v;
    // if (empty($v['title']) == false) {
    //     call_user_func($v['title']);
    // }
    foreach($v as $s_k => $s_v)
    if (is_callable($s_v)) {
        call_user_func($s_v);
    }
}

// var_dump($a);


// $b = '12a';
// $a = function () {
//     return 'Chào bạn: ' .'<br>Có năm sinh là: ';
// };
// function foo(){
// }
// if (is_callable($b)) {
//     print 'true';
// }else print 'false';

