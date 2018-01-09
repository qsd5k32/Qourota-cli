<?php
class cont {
    protected $controller;
    protected $method = 'index';
    public function __construct()
    {
          $this->Url();
    }

    /**
     * @return
     * this manage get
     */
    public function Url(){
        $url = isset($_GET['url']) ? $_GET['url']:'index';
        $url = explode('/',filter_var(rtrim($url,'/'),FILTER_SANITIZE_URL));
        $file = CONTROLLERS."$url[0].php";
        if( ($_SERVER['REQUEST_URI'] != "/\.[^.]+$/") and preg_match('/\.[^.]+$/',$_SERVER['REQUEST_URI']) ) {
            header ('Location: '.preg_replace('/\.[^.]+$/', '', $_SERVER['REQUEST_URI']));
        }
        if( ($_SERVER['REQUEST_URI'] != "index") and preg_match('{index$}',$_SERVER['REQUEST_URI']) ) {
            header ('Location: '.preg_replace('{index$}', '', $_SERVER['REQUEST_URI']));
        }
        if(file_exists($file)){
            require_once $file;
            $this->controller = new $url[0];
            unset($url[0]);
        }else{
            require_once "../app/controllers/Errors.php";
            $Error = new Errors();
            $Error->page404();
            return false;
        }
        if(isset($url[1])){
            if(!method_exists($this->controller,$url[1])){
                require "../app/controllers/Errors.php";
                $Error = new Errors();
                $Error->page404();
                return false;
            }else{
                if(isset($url[2])){
                    $this->method = $this->controller->{$url[1]}($url[2]);
                    unset($url[2]);
                }else{
                    $this->method = $this->controller->{$url[1]}();
                    unset($url[1]);
                }
            }

        }else{
            if(($_SERVER['REQUEST_URI'] != "/") and preg_match('{/$}',$_SERVER['REQUEST_URI']) ) {
                header ('Location: '.preg_replace('{/$}', '', $_SERVER['REQUEST_URI']));
            }
            if(method_exists($this->controller,"index")){
                $this->controller->index();
            }else{
                require "../app/controllers/Errors.php";
                $Error = new Errors();
                $Error->page404();
            }

        }
        return null;
    }
}