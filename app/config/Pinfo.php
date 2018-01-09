<?php
function Title(){
    $fName = isset($_GET['url']) ? $_GET['url']:'index';
    if ($fName == "index"){
        echo "Qourota Web Development & Web Design agency";
    }else{
        $fName = preg_replace('/[^A-Za-z]/',' ',$fName);
        echo "Qourota - ".$fName;
    }
}