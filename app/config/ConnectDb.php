<?php
/*@TODO badal connection*/
abstract class ConnectDb{
    public static $db;
    public static function connect(){
        try{
            /** @var PDO $this */
            self::$db = new PDO("mysql:host=localhost;dbname=Qourota","root","123456789");
        }catch(PDOException $e){
            echo'error:'.$e->getMessage();
        }
        return true;
    }

    /**
     *Close mysql connection
     */
    public function close(){
        $this->db = '';
    }
}