
<?php


class index extends controller{

    public function __construct()
    {
        parent::view();
        parent::model();
        $this->view->render("pages/index.html");
        $this->model->render("index",0);
    }
}
