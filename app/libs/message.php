<?php
class message {
    public $stmt;
    public $stmts;
    public $data;
    public function __construct()
    {
        ConnectDb::connect();
    }

    public $Errors = [];
    /*
     * send messages
     * */
    public function send($data = []){
        $info = array('userName'=> $data['userName'],'message'=> $data['message'],'plan'=>$data['plan']);
        foreach($info as $type => $value):
            if (strlen($value) <= 3):
                $this->Errors[] = 'please use more than 3 characters for ' . $type ;
            elseif (validate($value, $type)):
                $this->Errors[] =  "$type  not match make sure you're using a valid character";
            endif;
        endforeach;
        if(empty($this->Errors)):
            try {
                $this->stmt = ConnectDb::$db->prepare('INSERT INTO orders (user1, user2, message, plan, time) VALUES(:user1,:user2, :message, :plan, :time)');
                $this->stmt->bindParam(':user1', $data['userName']);
                $this->stmt->bindParam(':user2',$data['userName']);
                if(isset($data['user2'])) {
                    $this->stmt->bindParam(':user2', $data['user2']);
                }
                $this->stmt->bindParam(':message', $data['message']);
                $this->stmt->bindParam(':plan', $data['plan']);
                $time = time();
                $this->stmt->bindParam(':time', $time);
                return true;
            }catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        else :
            return false;
        endif;
    }
    /*
     * Read messages
     * */
    public function read($data = []){
        if(isset($data['user1'])){
            $this->stmts = ConnectDb::$db->prepare('SELECT * FROM orders WHERE user1 = :user1  ORDER BY time DESC');
            $this->stmts->bindParam(':user1',$data['user1']);
        }if(empty($data['user1'])){
            $this->stmts = ConnectDb::$db->prepare('SELECT * FROM orders GROUP BY user1 ORDER BY time ASC ');
        }
        $this->stmts->execute();
    }
}