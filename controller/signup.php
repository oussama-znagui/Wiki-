<?php
if (!$_POST) {
    header('Location: ../view/index.php');
    die("erroor");
}
session_start();


include '../config/connexion.php';
include '../model/user.php';

$fullName = $_POST['fName'] . $_POST['lName'];
$email = $_POST['email'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];

if ($password != $cpassword) {
    header('Location: ../view/signup.php?error=pass');
    die('error');
} else {

    $user = new User();
    $user->__set('fullName', $fullName);
    $user->__set('email', $email);
    $user->__set('password', $password);
    $user->__set('role', 0);
    if (!$user->checkEmail()) {
        header('Location: ../view/signup.php?error=mail');
        die('error');
    } else {
        $user->signup();
        $_SESSION['user'] = $user->selectUser();
        header('Location: ../view/index.php');
    }
}
