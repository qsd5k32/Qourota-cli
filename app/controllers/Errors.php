<?php
class Errors extends controller {
    public function page404()
    {

        parent::view();
        $this->view->render('404.html');
    }
}