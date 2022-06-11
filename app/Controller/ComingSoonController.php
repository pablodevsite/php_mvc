<?php
namespace App\Controller;
use \App\Core\Controller;
use \App\Core\Bootstrap;


class ComingSoonController extends Controller {

    public function __construct(public Bootstrap $bootstrap) {
        parent::__construct($bootstrap);
        //$this->setLayout('coming-soon');
    }

    public function index() {
        if(getenv('MAINTENANCE') === 'true') {
            $this->render('coming-soon.view.php', []);
        } else {
            $this->bootstrap->response->redirect('/');
        }
    }

}