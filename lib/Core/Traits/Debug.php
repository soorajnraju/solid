<?php

namespace Solid\Core\Traits;

/**
 * Debug methods defined here
 */
trait Debug
{
    function pre($alien, bool $exit=true){
        echo "<pre>";
        print_r($alien);
        $exit===true?die():'';
    }    
}
