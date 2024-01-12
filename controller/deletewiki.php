<?php

include '../config/connexion.php';
include '../model/wiki.php';
session_start();
if (!$_GET['wiki'] || !$_SESSION['user']) {
    header('Location: ../view/profil.php');
    die('errooor');
}

$wiki = new Wiki($_GET['wiki'], null, null, null, null, null, null, null, null);
$wiki->deleteWiki();

if (@$_SESSION['user']->__get('role') == 0) {
    header('Location: ../view/profil.php');
} elseif ($_SESSION['user']->__get('role') == 1) {
    header('Location: ../view/dashboard.php');
}
