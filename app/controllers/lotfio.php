
<?php


class lotfio extends controller{

    public function index()
    {
        parent::view();
        parent::model();
        $this->view->render("pages/lotfio.html");
        $this->model->render("lotfio",0);
    }
}
