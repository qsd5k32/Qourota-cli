<?php
require( CONFIG."Validation.php");
class User {
    private $inf;
    public $Errors;
    public $stmt;
    /** connect to database */
    public function __construct(){
        ConnectDb::connect();
    }
    protected function inUse($mail,$user){
        $this->inf = ConnectDb::$db->prepare('SELECT email ,userName, password FROM Users WHERE email=:email or userName = :userName');
        $this->inf->bindParam(':email',$mail);
        $this->inf->bindParam(':userName',$user);
        $this->inf->execute();
        return $this->inf->rowCount();
    }
    /**
     * @param string $fullName
     * @param string $userName
     * @param string $password
     * @param string $email
     * @param string $address
     * @param string $message
     * @return string
     */
    public function signUp($data = []){
        $info = array('name'=> $data['fullName'],'userName'=> $data['userName'],'address'=> $data['address'],'password'=> $data['password'],'email'=> $data['email']);
        foreach($info as $type => $value):
            if (strlen($value) <= 3):
                $this->Errors[] = 'please use more than 3 characters for ' . $type;
            elseif (validate($value, $type)):
                $this->Errors[] =  "$type  not match make sure you're using a valid character";
            endif;
        endforeach;
        if($this->inUse($data['email'],$data['userName']) > 0):
            $usr = $this->inf->fetchObject();
            if($usr->userName == $data['userName']):
                $this->Errors[] = 'this User name '.$data['userName'].' is already in use';
            elseif ($usr->email == $data['email']):
                $this->Errors[] = 'this email '.$data['email'].' is already in use';
            endif;
        endif;
        if(empty($this->Errors)):
                try {
                    $password = password_hash($data['password'], PASSWORD_DEFAULT);
                    $this->stmt = ConnectDb::$db->prepare('INSERT INTO Users (fullName, userName, password, email, address) VALUES(:fullname,:userName,:password,:email,:address)'
                    );
                    $this->stmt->bindParam(':fullname', $data['fullName']);
                    $this->stmt->bindParam(':userName', $data['userName']);
                    $this->stmt->bindParam(':password', $password);
                    $this->stmt->bindParam(':email', $data['email']);
                    $this->stmt->bindParam(':address', $data['address']);
                    return true;
                }catch (PDOException $e) {
                    echo $e->getMessage();
                    return false;
                }


        else :
            return false;
        endif;
    }

    /**
     * @param string $userMail
     * @param string $password
     * @return bool|null|string
     */
    public function signIn($userMail, $password) {
        $info = array('userMail' => $userMail, 'password' => $password);
        foreach ($info as $type => $value):
            if (empty($value)):
                $this->Errors[] = 'you set empty field';
            endif;
            if (validate($value, $type)):
                $this->Errors[] = "$type not match make sure you're using a valid character";
                return false;
            endif;
        endforeach;
        if($this->inUse($userMail,$userMail) == 0):
            $this->Errors[] = 'Email or password it not valid';
            return false;
        endif;
        if (empty($this->Errors)):
            if($this->inUse($userMail, $userMail) == 1):
                $usr = $this->inf->fetchObject();
                if($usr->userName == $userMail or $usr->email == $userMail and password_verify($password,$usr->password)):
                    return true;
                else:
                    $this->Errors[] = "Email or password it not valid";
                    return false;
                endif;
            endif;
        else:
            return false;
        endif;
    }
    public function update($data = [])
    {
        $info = array('plan' => $data['plan'], 'password' => $data['password'], 'userName' => $data['userName']);
        foreach ($info as $type => $value):
            if (empty($value)):
                $this->Errors[] = 'you set empty field';
            endif;
            if (validate($value, $type)):
                $this->Errors[] = "$type not match make sure you're using a valid character";
                return false;
            endif;
        endforeach;
        if (empty($this->Errors)):
            if ($this->inUse('unknown', $data['userName']) == 1):
                $usr = $this->inf->fetchObject();
                if ($usr->userName == $data['userName'] and password_verify($data['password'], $usr->password)):
                    $this->stmt = ConnectDb::$db->prepare("UPDATE Users SET plan = :plan ,password = :password WHERE userName = ".$data['userName']);
                    $this->stmt->bindParam(':plan', $data['plan']);
                    if (isset($data['password']))
                        $this->stmt->bindParam(':password', $data['password']);
                    return true;
                else:
                    $this->Errors[] = "password it not valid";
                    return false;
                endif;
            endif;
        else:
            return false;
        endif;
    }
}