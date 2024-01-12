<?php

include '../config/connexion.php';
include '../model/wiki.php';
include '../model/tag.php';

session_start();
if (!$_SESSION['user']) {
    header('Location: ../view/index.php');
    die("eroor");
}


if (!$_GET['wiki']) {
    header('Location: ../view/profil.php');
    die('errooor');
}

$wiki = new Wiki($_GET['wiki'], null, null, null, null, null, null, null, null);
$wiki = $wiki->getWiki();
// print_r($wiki);

if ($_FILES['image']['name']) {
} else {
}


// $Categories = Categorie::getCategories();
// $tags = Tag::getTags();
