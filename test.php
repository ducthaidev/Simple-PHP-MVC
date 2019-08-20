<?php
$request_exploding = explode('/', '/hello/thai/nguyen/duc/2000');
$uri_exploding = explode('/', '/hello/{ten}/nguyen/{dem}/{sn}')[2];
var_dump($uri_exploding).PHP_EOL;
echo '-----------------------'.PHP_EOL;
// $amount_uri_exploding = count($uri_exploding);
// $amount_request_exploding = count($request_exploding);
// if ($amount_request_exploding == $amount_uri_exploding) {    
//     $different_indexes = [];    
//     for ($i = 0; $i < $amount_uri_exploding; $i++) {
//         if (strcmp($request_exploding[$i], $uri_exploding[$i]) !== 0) {
//             array_push($different_indexes, $i);
//         }
//     }
//     for ($j = 0, $i = 0; $i < $amount_uri_exploding - count($different_indexes); $i++, $j++) {
//         if ($i == 0) {
//             array_splice($request_exploding, $different_indexes[$i], 1);
//             array_splice($uri_exploding, $different_indexes[$i], 1);
//         } else {
//             array_splice($request_exploding, $different_indexes[$i]-$j, 1);    
//             array_splice($uri_exploding, $different_indexes[$i]-$j, 1); 
//         }
//     }
//     for ($i = 0; $i < count($uri_exploding); $i++) {
//         if (strcmp($request_exploding[$i], $uri_exploding[$i]) !== 0) {
//             return false;
//         }
//     }
// }
