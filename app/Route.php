<?php
use Core\Http\Route;

Route::get('hello', function () {
    echo 'hellauuuuuuu';
});
Route::get('hello/thai', 'haha');
Route::view('myview', 'webpage');
// Route::get( 'xin-chao/{ten}/{namsinh}' ,'MyController@getxinchao');
