<?php
use Core\Http\Route;
//params in Route class must be correct order with params in Controller class
Route::get('hello', function () {
    echo 'hellauuuuuuu';
});
Route::get('hello/thai', 'haha');
Route::view('myview', 'webpage');
Route::get('hello/{ten}/nguyen/{dem}/{sn}', 'MyController@xinChao');
