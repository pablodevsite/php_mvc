<?php
namespace App\Controller;
use \App\Core\Controller;
use \App\Core\Bootstrap;

class HomeController extends Controller {

    public function __construct(public Bootstrap $bootstrap) {
        parent::__construct($bootstrap);
    }

    public function index() {
        // recupero dati dal database
        $descrizioneInDB = "il mio messaggio <script>alert('ciao ciao');</script>";
        //gb_dd($descrizioneInDB);
        //die;
        $this->render('home.view.php', [
            'descrizione' => $descrizioneInDB
            , 'pattern1' => "<script>alert('hola');</script>"
            , 'pattern2' => "hello"
        ]);
    }

    public function formtest()
    {
        $this->render('formtest.view.php', []);
    }

    public function formtest_post() 
    {
        $post = $this->bootstrap->request->getPost();
        $name = $post["name"];
        $surname = $post["surname"];
        $message = "name = " . $name . " - surname = " . $surname;
        
        $this->render('formtest.view.php', [
            'message' => $message
        ]);
    }

}