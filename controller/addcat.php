<?php
include '../config/connexion.php';

include '../model/categorie.php';
include '../model/user.php';

session_start();
if (!$_SESSION['user'] || $_SESSION['user']->__get('role') != 1 || !$_POST['cat']) {
    header('Location: ../view/dashboard.php');
    die('errooor');
}
$cat = $_POST['cat'];
$content = $_POST['content'];

// echo $cat . ' -> ' . $content;
$newCat = new Categorie(null, $cat, $content);
$newCat->addCategorie();
header('Location: ../view/dashboard.php#categorie');
