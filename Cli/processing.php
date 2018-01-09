<?php


class Qcli
{
    private $error = 0;
    private $action;
    private static $actions;
    private $name;
    private static $Cfile;
    private static $Mfile;
    private static $Vfile;
    private $files;

    public function __construct($data = array())
    {
        extract($data);
        $this->action = $action;
        $this->name = $name;
        $this->valid();
    }
    public function valid(){

        if(empty($this->action)) $this->error = 1;

        self::$actions = ['--help','create'];

        if($this->action == '--help') $this->help();
        if($this->action == 'create') $this->create();
        if($this->error == 1) print("use qourota --help for more information \n"); exit();

    }
    public function create(){
        self::$Cfile = CONTROLLERS.$this->name . ".php";
        self::$Vfile = VIEW ."pages".SP.$this->name .".html";
        self::$Mfile = MODEL.$this->name . ".php";
        $this->files = [self::$Cfile,self::$Vfile,self::$Mfile];
        if($this->error === 0 and $this->action == "create"){
            if(file_exists(self::$Cfile)){
                echo "this page already exist pleas use another name\n";
            }else{
            $newCntrl = fopen(self::$Cfile,"w");
            fwrite($newCntrl, '
<?php


class '.$this->name.' extends controller{

    public function index()
    {
        parent::view();
        parent::model();
        $this->view->render("pages/'.$this->name.'.html");
        $this->model->render("'.$this->name.'",0);
    }
}
');
            fclose($newCntrl);
            $newView = fopen(self::$Vfile,"w");
            fwrite($newView,"<h1>This is $this->name</h1> ");
            fclose($newView);
            $newModel = fopen(self::$Mfile,"w");
            fwrite($newModel,"<?php echo'".$this->name."';");
            fclose($newModel);
            echo "the page ".$this->name." was created with success\n";
          }
        }

    }
    public function help(){
        print("to create new page use \nqourota create page_name\n");
    }

}
