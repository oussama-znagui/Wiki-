<?php
if (!$_POST) {
    header('Location: ../view/index.php');
    die("erroor");
}
session_start();


include '../config/connexion.php';
include '../model/user.php';

$email = $_POST['email'];
$password = $_POST['password'];
$user = new User();
$user->__set("email", $email);
$user->__set("password", $password);
if (!$user->login()) {
    header('Location: ../view/login.php?error=log');
    die('error');
} else {
    echo "1111";
}
