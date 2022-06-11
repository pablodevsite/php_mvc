<?php
namespace App\Core;
use \App\Core\Bootstrap;

class Controller {

    public function __construct(public Bootstrap $bootstrap) {
    }

    public function setLayout($layout) {
        $this->bootstrap->view->layout = $layout;
    }

    public function render($view_name, $args = []) {
        $content = $this->bootstrap->view->render($view_name, $args);

        //set the content to display
        $this->bootstrap->response->setContent($content);
    }

}