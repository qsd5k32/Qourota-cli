
<?php


class oodino extends controller{

    public function index()
    {
        parent::view();
        parent::model();
        $this->view->render("pages/oodino.html");
        $this->model->render("oodino",0);
    }
}
