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

    public function signup(){
        $sql = DB::connexion()->prepare("INSERT into users values(:id,:fullName,:email,:pass,:role)");
        $sql->bindParam(":id",NULL);
        $sql->bindParam(":fullName", $this->fullName);
        $sql->bindParam(":email", $this->email);
        $sql->bindParam(":pass", $this->password);
        $sql->bindParam(":role", $this->role);
        $sql->execute();
        }
        


}