<?php

if (!$_POST) {
    header('Location: ../view/index.php');
    die("erroor");
}



include '../config/connexion.php';
include '../model/user.php';
session_start();
$email = $_POST['email'];
$password = $_POST['password'];
$password = md5($password);
$user = new User();
$user->__set("email", $email);
$user->__set("password", $password);

if (!$user->login()) {
    header('Location: ../view/login.php?error=log');
    die('error');
} else {



    // print_r($user->login());
    $_SESSION['user'] = $user->login();
    print_r($_SESSION['user']);
    header('Location: ../view/index.php');
}
