<?php
class User
{
    private $id_user;
    private $fullName;
    private $email;
    private $password;
    private $role;

    public function __construct()
    {
    }

    public function __get($prop)
    {
        return $this->$prop;
    }
    public function __set($prop, $value)
    {
        return $this->$prop = $value;
    }

    public function signup()
    {
        $sql = DB::connexion()->prepare("INSERT into users values(:id,:fullName,:email,:pass,:role)");
        $id = NULL;
        $sql->bindParam(":id", $id);
        $sql->bindParam(":fullName", $this->fullName);
        $sql->bindParam(":email", $this->email);
        $sql->bindParam(":pass", $this->password);
        $sql->bindParam(":role", $this->role);
        $sql->execute();
    }

    public function checkEmail()
    {
        $sql = DB::connexion()->prepare("SELECT * from users where email = :email");
        $sql->bindParam(':email', $this->email);
        $sql->execute();
        if ($sql->rowCount() != 0) {
            return false;
        }
        return true;
    }

    public function selectUser()
    {
        $sql = DB::connexion()->prepare("SELECT * from users where email = :email");
        $sql->bindParam(':email', $this->email);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        ///////////////////////////
        return $result;
    }

    public function login()
    {
        $sql = DB::connexion()->prepare("SELECT * from users where email = :email and password = :pass");
        $sql->bindParam(':email', $this->email);
        $sql->bindParam(':pass', $this->password);
        $sql->execute();
        if ($sql->rowCount() == 0) {
            return false;
        } else {
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            $user = new User();
            $user->__set("id_user", $result['id_user']);
            $user->__set("fullName", $result['fullName']);
            $user->__set("email", $result['email']);
            $user->__set("password", $result['password']);
            $user->__set("role", $result['role']);
            return $user;
        }
    }
}
