<?php

namespace Solid\Core;

use Exception;
use Solid\Core\Http\SolidRequest;
use Solid\Core\Http\RequestHandler;
use stdClass;

class Bootstrap {

    private $app = null;

    public function __construct()
    {
        $this->app = Solid::getInstance();

        $this->initRequest(new SolidRequest());
    }

    public function initRequest(SolidRequest $request){
        $this->app->http = new stdClass();
        $this->app->http->request = $request;
        $this->handleRequest();
        $this->dispatchRequest();

    }

    public function handleRequest(){
        $requestHandler = new RequestHandler($this->app->http->request);
        unset($requestHandler);
    }

    public function dispatchRequest(){
        if(!empty($this->app->live_controller)){
            $controller_class = "\App\\Controllers\\".$this->app->live_controller;
        }else{
            $controller_class = "\App\\Controllers\\Welcome";
        }
        $action = isset($this->app->live_action)?$this->app->live_action:null;
        
        if(class_exists($controller_class)){
            $controller = new $controller_class();
        }else{
            header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
            echo "404";
            return;
        }

        if(method_exists($controller, 'index') && empty($action)){
            return $controller->index();
        }else if(method_exists($controller, $action)){
            return $controller->$action();
        }else{
            //retrun 404
            header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
            echo "404";
            return;
        }
    }
}