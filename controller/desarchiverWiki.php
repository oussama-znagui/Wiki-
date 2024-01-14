<?php

include '../config/connexion.php';
include '../model/wiki.php';
session_start();
if (!$_GET['wiki'] || !$_SESSION['user']) {
    header('Location: ../view/profil.php');
    die('errooor');
}

$idw = $_GET['wiki'];
$wiki = new Wiki($idw, null, null, null, null, null, null, null, null, null);
$wiki = $wiki->getWiki();
$wiki->désarchiverWiki();
header('Location: ../view/dashboard.php');
