<?php
namespace App\Core;

class Request {
    private string $path;
    private string $method;
    private array $post;

    public function __construct() {
        $this->path = $this->getRequestPath();
        $this->method = $this->getRequestMethod();
        $this->post = $this->getPost();
    }

    public function getPost() {
        return $_POST ?? [];
    }

    public function getRequestPath() {
        $path = rtrim($_SERVER['REQUEST_URI'],"/");
        $url_subfolder = getenv("URL_SUBFOLDER");

        if(!empty($url_subfolder))
        {
            $path = substr($path, strlen($url_subfolder) + 1);
        }
        return $path;
    }

    public function getRequestMethod() {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

}