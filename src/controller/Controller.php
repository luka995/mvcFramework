<?php

namespace app\controller;

abstract class Controller 
{
    
    public function run()
    {
        $actionId = $_GET['action'] ?? 'index';
        $method = 'action' . ucfirst($actionId); 
        return $this->$method();
    }
    
    public static function create()
    { 
        $controlerId = $_GET['controller'] ?? 'Site';
        $controllerClass = "\\app\\controller\\".$controlerId."Controller";
        if ( ! class_exists($controllerClass)) {
            throw new \Exception('Traženi kontroler ne postoji');
        }
        return new $controllerClass();        
    }
    
    public function redirect($location)
    {
        header("Location:$location");
        die();
    }
    
}
