<?php

abstract class Autoload
{
    public static function inclusionAuto($className)
    {
        // "C:\xampp\htdocs\entrprise    /       controller\Controller     .php"
        require_once __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';
    }
}
spl_autoload_register(['Autoload', 'inclusionAuto']);



// TEST
// $c = new controller\Controller;