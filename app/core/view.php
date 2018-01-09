<?php
class view{
    public function render($path){

        require_once VIEW."$path";

    }
}