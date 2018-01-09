
<?php


class clea extends controller{

    public function index()
    {
        parent::view();
        parent::model();
        $this->view->render("pages/clea.html");
        $this->model->render("clea",0);
    }
}
