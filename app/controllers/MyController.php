<?php
namespace App\Controllers; 

use Core\Http\Controller;

class MyController 
{
    public function xinChao ($ten, $dem, $sn)
    {
        echo 'xin chao ' . $dem . $ten . $sn;
    }
}