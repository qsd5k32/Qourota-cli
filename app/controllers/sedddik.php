
<?php


class sedddik extends controller{

    public function index()
    {
        parent::view();
        parent::model();
        $this->view->render("pages/sedddik.html");
        $this->model->render("sedddik",0);
    }
}
