<?php
include '../config/connexion.php';
include '../model/wiki.php';
$data = json_decode(file_get_contents("php://input"), true);


$result = Wiki::getWikisAJAX($data['cherche']);
$wikis = array();
foreach ($result as $wiki) {
    $ww = [
        'id' => $wiki->__get("id_wiki"),
        'titre' => $wiki->__get("titre"),
        'image' => $wiki->__get("image"),
        'idCat' => $wiki->categorie->__get("id_cat"),
        'date' => $wiki->__get("crationDate"),
    ];
    array_push($wikis, $ww);
}

echo json_encode($wikis);
