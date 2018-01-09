
<?php


class haha extends controller{

    public function index()
    {
        parent::view();
        parent::model();
        $this->view->render("pages/haha.html");
        $this->model->render("haha",0);
    }
}
