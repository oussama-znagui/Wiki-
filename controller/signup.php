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

if (!preg_match('@[A-Z]@', $password) || !preg_match('@[a-z]@', $password) || !preg_match('@[0-9]@', $password) || strlen($password) < 8) {
    header('Location: ../view/signup.php?error=passF');
    die('error');
}

if ($password != $cpassword) {
    header('Location: ../view/signup.php?error=pass');
    die('error');
} else {
    $password = md5($password);
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
        $row = $user->selectUser();
        $newUser = new User();
        $newUser->__set('id_user', $row[0]["id_user"]);
        $newUser->__set('fullName', $row[0]["fullName"]);
        $newUser->__set('email', $row[0]["email"]);
        $newUser->__set('password', $row[0]["password"]);
        $newUser->__set('role', $row[0]["role"]);
        $_SESSION['user'] = $newUser;
        header('Location: ../view/index.php');
    }
}
