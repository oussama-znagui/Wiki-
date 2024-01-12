<?php
include '../config/connexion.php';
include '../model/categorie.php';
include '../model/user.php';
session_start();
if (!$_GET['cat'] || !$_SESSION['user'] || $_SESSION['user']->__get('role') != 1) {
    header('Location: ../view/dashboard.php');
    die('errooor');
}
$cat = $_POST['cat'];
$desc = $_POST['content'];

$NEWcategorie = new Categorie($_GET['cat'], $cat, $desc);

$NEWcategorie->updateCat();
$NEWcategorie = $NEWcategorie->getCat();
print_r($NEWcategorie);
header('Location: ../view/dashboard.php#categorie');
