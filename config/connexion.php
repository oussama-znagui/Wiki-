<?php
include 'config.php';
class DB
{
    private $host;
    private $user;
    private $pass;
    private $db;

    public function __construct()
    {
    }
    public static function connexion()
    {
        try {
            $conn = new PDO("mysql:host=" . host . ";dbname=" . db, user, pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo 'connexion 0' . $e->getMessage();
        }
    }
}

DB::connexion();
