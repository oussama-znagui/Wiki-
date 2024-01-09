<?php
class User{
    private $id_user;
    private $fullName;
    private $email;
    private $password;
    private $role;

    public function __construct(){
        
    }

    public function __get($prop){
        return $this->$prop;
    }
    public function __set($prop,$value)
    {
        return $this->$prop = $value;
    }


}