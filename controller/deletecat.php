<?php
include '../config/connexion.php';

include '../model/categorie.php';
include '../model/user.php';

session_start();
if (!$_SESSION['user'] || $_SESSION['user']->__get('role') != 1 || !$_GET['cat']) {
    header('Location: ../view/dashboard.php');
    die('errooor');
}

$idcat = $_GET['cat'];
$cat = new Categorie($idcat, null, null);
$cat = $cat->getCat();
$cat->DeleteCat();
header('Location: ../view/dashboard.php#categorie');

// print_r($cat);
