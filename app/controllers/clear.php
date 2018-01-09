
<?php


class clear extends controller{

    public function index()
    {
        parent::view();
        parent::model();
        $this->view->render("pages/clear.html");
        $this->model->render("clear",0);
    }
}
