<?php
if (!$_POST) {
    header('Location: index.php');
}


include '../config/connexion.php';
include '../model/wiki.php';
$date = date("Y-m-d");
session_start();

$image_name = $_FILES['image']['name'];
$tmp_name = $_FILES['image']['tmp_name'];
$error = $_FILES['image']['error'];


$image_extention = pathinfo($image_name, PATHINFO_EXTENSION);
$image_extention = strtolower($image_extention);

$new_name = uniqid("IMG", true) . '.' . $image_extention;
$img_upload_path = '../media/' . $new_name;
move_uploaded_file($tmp_name, $img_upload_path);

$titre = $_POST['titre'];
$content = $_POST['content'];
$categorie = $_POST["cat"];
$tags = $_POST["tags"];
print_r($tags);
echo $titre;
$idUser = $_SESSION['user']->__get('id_user');
$wiki = new Wiki(NULL, $titre, $content, $new_name, $date, $idUser, $categorie, null, null, 1);
$wiki->addWiki();
header('Location: ../view/profil.php');
