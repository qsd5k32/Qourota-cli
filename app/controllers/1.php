
<?php


class 1 extends controller{

    public function index()
    {
        parent::view();
        parent::model();
        $this->view->render("pages/1.html");
        $this->model->render("1",0);
    }
}
