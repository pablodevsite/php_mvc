<?php
namespace App\Middleware;
use \App\Core\Bootstrap;
use \App\Core\Exception\ForbiddenException;

class ProfileMiddleware {
    public function exec(Bootstrap $bootstrap, array $args) { 
        
        if(in_array("myvalue", $args)) //example
        {
            throw new ForbiddenException();
        }        
    }
}