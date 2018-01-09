
<?php


class heha extends controller{

    public function index()
    {
        parent::view();
        parent::model();
        $this->view->render("pages/heha.html");
        $this->model->render("heha",0);
    }
}
