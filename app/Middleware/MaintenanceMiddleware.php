<?php
namespace App\Middleware;
use \App\Core\Bootstrap;

class MaintenanceMiddleware {
    public function exec(Bootstrap $bootstrap, array $args) { 
        if(getenv('MAINTENANCE') === 'true' && $bootstrap->request->getRequestPath() !== '/coming-soon') {
            $bootstrap->response->redirect('/coming-soon');
        }
    }
}