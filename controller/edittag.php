<?php
include '../config/connexion.php';
include '../model/tag.php';
include '../model/user.php';
session_start();
if (!$_GET['tag'] || !$_SESSION['user'] || $_SESSION['user']->__get('role') != 1) {
    header('Location: ../view/dashboard.php');
    die('errooor');
}
$tag = $_POST['tag'];
$idTag = $_GET['tag'];
$newTag = new Tag($idTag, $tag);
$newTag->updateTag();

header('Location: ../view/dashboard.php#tags');
