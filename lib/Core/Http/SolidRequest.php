<?php

namespace Solid\Core\Http;

use Symfony\Component\HttpFoundation\Request;

class SolidRequest {

    public function __construct()
    {
        $this->request = Request::createFromGlobals();
    }
}