<?php
class fetch {
    public $inf;
    public $data;
    public function __construct()
    {
        ConnectDb::connect();
    }
    public function User($mail,$user){
            $this->inf = ConnectDb::$db->prepare('SELECT email ,userName, password, admin FROM Users WHERE email=:email or userName = :userName');
            $this->inf->bindParam(':email',$mail);
            $this->inf->bindParam(':userName',$user);
            $this->inf->execute();
            $this->data = $this->inf->fetchObject();
    }
    public function allUsers(){
        $this->inf = ConnectDb::$db->prepare('SELECT * FROM Users');
        $this->inf->execute();
        //$this->data = $this->inf->fetchObject();
    }
}