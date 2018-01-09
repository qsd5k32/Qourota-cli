<?php



class ClientData{


    public $inf;

    public function __construct()
    {
        ConnectDb::connect();

    }

    public function Already($ip){
        $this->inf = ConnectDb::$db->prepare('SELECT * FROM visitors WHERE visitorIP = :visitorIP');
        $this->inf->bindParam(':visitorIP',$ip);
        $this->inf->execute();
        return $this->inf->rowCount();
    }
    public function NewVisit($IP){

        $ClientInfo = new ClientInfo();;
        if($this->Already($IP) == 0){
            $this->inf = ConnectDb::$db->prepare('INSERT INTO visitors ( visitorIP, Browser, OS, Country) VALUES (:visitorIP,:Browser,:OS,:Country)');
            $Ip = $ClientInfo::Get('Ip');
            $Browser = $ClientInfo::Get('Browser');
            $OS = $ClientInfo::Get('OS');
            $Country = $ClientInfo::Get('Country');

            $this->inf->bindParam(':visitorIP',$Ip);
            $this->inf->bindParam(':Browser',$Browser);
            $this->inf->bindParam(':OS',$OS);
            $this->inf->bindParam(':Country',$Country);
            $this->inf->execute();
        }
    }
}