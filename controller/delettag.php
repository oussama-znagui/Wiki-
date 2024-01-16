<?php
include '../config/connexion.php';

include '../model/tag.php';
include '../model/user.php';

session_start();
if (!$_SESSION['user'] || $_SESSION['user']->__get('role') != 1 || !$_GET['tag']) {
    header('Location: ../view/dashboard.php');
    die('errooor');
}

$idtag = $_GET['tag'];
$tag = new Tag($idtag, null);
$tag->DeleteTag();
header('Location: ../view/dashboard.php#tags');
