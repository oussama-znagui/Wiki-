<?php
if (!$_POST) {
    header('Location: index.php');
}


include '../config/connexion.php';
include '../model/wiki.php';
$date = date("Y-m-d");

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

$wiki = new Wiki(NULL, $titre, $content, $new_name, $date, 1, $categorie, null, null);
$wiki->addWiki();