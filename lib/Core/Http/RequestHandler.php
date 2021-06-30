<?php

namespace Solid\Core\Http;

use Solid\Core\Solid;

class RequestHandler {

    protected $request;
    public $urlParams;


    public function __construct(SolidRequest $request)
    {
        $this->request = $request;

        $this->initExploding();
    }

    public function initExploding(){
        $this->urlParams = explode('/', $this->request->request->server->get('REQUEST_URI'));
        
        isset($this->urlParams[1])?Solid::getInstance()->live_controller = $this->urlParams[1]:null;
        isset($this->urlParams[2])?Solid::getInstance()->live_action = $this->urlParams[2]:null;
    }

}