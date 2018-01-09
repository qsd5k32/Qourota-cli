<?php




define("SP" , DIRECTORY_SEPARATOR);
define("APP", "..".SP."app".SP);
define("CONFIG",APP."config".SP);
define("LIBS",APP."libs".SP);
define("MODEL",APP."model".SP);
define("CONTROLLERS",APP."controllers".SP);
define("VIEW",APP."view".SP);
define("CORE",APP."core".SP);



function requireAll($data = [],$html = false){
    if($html === false){
        foreach ($data as $file){
            require_once $file . ".php";
        }
    }else{
        foreach ($data as $file){
            require_once $file . ".html";
        }
    }
}