<?php
class model {
    public function __construct()
    {
        session_start();
    }
    public function render($name,$data = true){
            if($data === true):
                require_once "../app/config/ConnectDb.php";
                require_once "../app/model/$name.php";
                new $name;
            else:
                require_once "../app/model/$name.php";
            endif;
    }
}



