<?php
namespace App\Core;
use \App\Core\Bootstrap;

/*
with $args = ["var" => "message"]
dirrent way to print a variable

using htmlspecialchars
{{var}} 
<?php $this->echo($var); ?> 
<?php $this->echo($args["var"]); ?> 
<?php htmlspecialchars($args["var"]); ?>

raw method
{!!var!!}
<?php $this->raw($var); ?> 
<?php $this->raw($args["var"]); ?>
<?php echo $var ?>
*/


class View {

    public string $layout = 'default.view';
    public string $view_content = "";
    public string $view_name = "";
    public array $args = [];

    public function __construct(public Bootstrap $bootstrap) {}

    
    public function render($view_name, $args = []) 
    {
        $this->view_name = $view_name;
        $this->args = $args;
        extract($args);

        //start outpu buffering view
        ob_start();
        include __DIR__ . "/../../views/" . $this->view_name;
        $this->view_content = ob_get_clean();
        //ob_end_flush();

        //start outpu buffering layout 
        ob_start(); 
        include __DIR__ . "/../../views/layout/" . $this->layout . ".php";
        return ob_get_clean();
    }
    
    public function renderSection($section, $args)
    {    
        //get only the correct section
        $partial_content = gb_get_string_between($this->view_content, "<phpsection_" . $section . ">", "</phpsection_" . $section . ">");
        
        //replace {{...}}
        $matches = [];
        preg_match_all('/{{\s*\w+\s*}}/m', $partial_content, $matches, PREG_SET_ORDER, 0);
        for ($i = 0; $i < count($matches); $i++) {
            $temp = str_replace("{{", "", $matches[$i][0]);
            $temp = str_replace("}}", "", $temp);
            $partial_content = str_replace($matches[$i][0], $this->get_secure_string($this->args[trim($temp)]), $partial_content);
        }

        //replace {!!...!!}
        $matches = [];
        preg_match_all('/{!!\s*\w+\s*!!}/m', $partial_content, $matches, PREG_SET_ORDER, 0);
        for ($i = 0; $i < count($matches); $i++) {
            $temp = str_replace("{!!", "", $matches[$i][0]);
            $temp = str_replace("!!}", "", $temp);
            $partial_content = str_replace($matches[$i][0], $this->get_raw_string($this->args[trim($temp)]), $partial_content);
        }

        echo $partial_content;
    }

    public function old($nameinput, $oldvar)
    {
        $post = $this->bootstrap->request->getPost();
        $data = $post[$nameinput] ?? $oldvar;
        echo $data;
    }

    public function url($var)
    {
        $APP_URL = getenv("APP_URL");
        $var = $var ?? "";
        echo rtrim($APP_URL, "/") . "/" . trim($var, "/");
    }
    public function echo($var)
    {
        $temp = $var ?? "";
        echo $this->get_secure_string($var);
    }
    public function raw($var)
    {
        $temp = $var ?? "";
        echo $this->get_raw_string($var);
    }

    private function get_secure_string($str) : string
    {
        return htmlspecialchars($str);
    }
    private function get_raw_string($str) : string
    {
        return $str;
    }

}