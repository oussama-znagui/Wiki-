<?php

include '../config/connexion.php';
include '../model/wiki.php';

if (!$_GET['wiki']) {
    header('Location: ../view/profil.php');
    die('errooor');
}

$wiki = new Wiki($_GET['wiki'], null, null, null, null, null, null, null, null);
$wiki = $wiki->getWiki();
print_r($wiki);
