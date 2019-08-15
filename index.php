<?php
require_once __DIR__ . '/autoload.php';

use Core\Http\Request;
use Core\Http\Route;

$request = Request::instantiate();
$request->getAttribute();

$route = Route::instantiate();
$route->getRequest($request);
$route->show();
