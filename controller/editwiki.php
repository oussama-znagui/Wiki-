<?php

include '../config/connexion.php';
include '../model/wiki.php';
include '../model/tag.php';
include '../model/wikiTAgs.php';

session_start();
if (!$_SESSION['user']) {
    header('Location: ../view/index.php');
    die("eroor");
}


if (!$_GET['wiki']) {
    header('Location: ../view/profil.php');
    die('errooor');
}

$wiki = new Wiki($_GET['wiki'], null, null, null, null, null, null, null, null, null);
$wiki = $wiki->getWiki();
// print_r($wiki);
$new_name = $wiki->__get('image');
$titre = $_POST['titre'];
$content = $_POST['content'];
$categorie = $_POST["cat"];
$tags = $_POST["tags"];

if ($_FILES['image']['name']) {
    $image_name = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $error = $_FILES['image']['error'];


    $image_extention = pathinfo($image_name, PATHINFO_EXTENSION);
    $image_extention = strtolower($image_extention);

    $new_name = uniqid("IMG", true) . '.' . $image_extention;
    $img_upload_path = '../media/' . $new_name;
    move_uploaded_file($tmp_name, $img_upload_path);
}
$newWiki = new Wiki($wiki->__get('id_wiki'), $titre, $content, $new_name, null, null, $categorie, null, null, 1);
$newWiki->updateWiki();
// print_r($newWiki);
$tag = new Tag(null, null);

$wikiTags = new WikiTAgs(null, $newWiki, $tag);
$wikiTags->deleteTags();


foreach ($tags as $idtag) {
    $tag = new Tag($idtag, null);
    $tag = $tag->getTag();
    $wikiTag = new WikiTAgs(null, $newWiki, $tag);
    // print_r($wikiTag);
    $wikiTag->addWikiTags();
    // echo "a";
}


if (@$_SESSION['user']->__get('role') == 0) {
    header('Location: ../view/profil.php');
} elseif ($_SESSION['user']->__get('role') == 1) {
    header('Location: ../view/dashboard.php');
}



// $Categories = Categorie::getCategories();
// $tags = Tag::getTags();
