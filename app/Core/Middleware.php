<?php
namespace App\Core;
use \App\Core\Boostrap;

class Middleware {

    public function __construct(
        public Bootstrap $bootstrap,
        public array $configMiddleware = []
    ) {}

    public function execute() {
        $req = $this->bootstrap->request->getRequestPath();
        foreach($this->configMiddleware as $basePath => $middlewareGroup) {
            if(str_starts_with($req, $basePath)) {
                $this->executeMiddleware($middlewareGroup);
            }
        }
    }

    private function executeMiddleware($middlewares) 
    {
        //last item contains args
        $len = count($middlewares) - 1;
        $args = $middlewares[count($middlewares) - 1];
        
        if(is_string($args))
        {
            //there's no args
            $len = count($middlewares);
            $args = [];
        }
        
        for($k = 0; $k < $len; $k++)
        {
            $middleware = $middlewares[$k];
            (new $middleware)->exec($this->bootstrap, $args); 
        }
        
    }

}