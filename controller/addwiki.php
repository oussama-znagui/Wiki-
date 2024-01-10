<?php
if (!$_POST) {
    header('Location: index.php');
}


include '../config/connexion.php';
include '../model/wiki.php';


