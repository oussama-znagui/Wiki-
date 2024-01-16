<?php
if (!$_POST) {
    header('Location: index.php');
}


include '../config/connexion.php';
include '../model/wiki.php';
include '../model/tag.php';
include '../model/wikiTAgs.php';
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
// print_r($tags);
// echo $titre;
$idUser = $_SESSION['user']->__get('id_user');
$wiki = new Wiki(NULL, $titre, $content, $new_name, $date, $idUser, $categorie, null, null, 1);
$wiki->addWiki();
$idThisWiki = $wiki->selectLastWikiOfUser();

$thiswiki = new Wiki($idThisWiki, null, null, null, null, null, null, null, null, null);
$thiswiki = $thiswiki->getWiki();

foreach ($tags as $idtag) {
    $tag = new Tag($idtag, null);
    $tag = $tag->getTag();
    $wikiTag = new WikiTAgs(null, $thiswiki, $tag);
    // print_r($wikiTag);
    $wikiTag->addWikiTags();
    // echo "a";
}
header('Location: ../view/profil.php');
