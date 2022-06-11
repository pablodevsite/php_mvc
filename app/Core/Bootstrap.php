<?php
namespace App\Core;
use \App\Core\View;
use \App\Core\DatabasePDO;
use \App\Core\Middleware;
use \App\Core\Router;
use \App\Core\Request;
use \App\Core\Response;
use \App\Core\Exception\NotFoundException;
use \App\Core\Exception\ForbiddenException;

class Bootstrap {
    public static Bootstrap $bootstrap;
    public Request $request;
    public View $view;
    public Response $response;
    public Router $router;
    public Middleware $middleware;
    public DatabasePDO $dbpdo;

    public function __construct(public array $config) {
        self::$bootstrap = $this;
        $this->request = new Request();        
        $this->view = new View($this);
        $this->response = new Response($this->view);
        $this->router = new Router($this);
        $this->middleware = new Middleware($this, $config['middleware']);
        $this->dbpdo = new DatabasePDO();
    }


    public function run() {
        try {            
            $this->router->resolve();
        } catch(NotFoundException $e) {
            $this->response->setException($e);            
        } catch(ForbiddenException $e) {
            $this->response->setException($e);            
        }
        $this->response->send();
    }

}