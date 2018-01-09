
<?php


class page extends controller{

    public function index()
    {
        parent::view();
        parent::model();
        $this->view->render("pages/page.html");
        $this->model->render("page",0);
    }
}
