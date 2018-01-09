
<?php


class hello extends controller{

    public function index()
    {
        parent::view();
        parent::model();
        $this->view->render("pages/hello.html");
        $this->model->render("hello",0);
    }
}
