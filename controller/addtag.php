<?php
include '../config/connexion.php';

include '../model/tag.php';
include '../model/user.php';

session_start();
if (!$_SESSION['user'] || $_SESSION['user']->__get('role') != 1 || !$_POST['tag']) {
    header('Location: ../view/index.php');
    die('errooor');
}
$tag = $_POST['tag'];
$tag = new Tag(null, $tag);
$tag->addTag();
header('Location: ../view/dashboard.php#tags');
