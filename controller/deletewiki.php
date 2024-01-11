<?php

include '../config/connexion.php';
include '../model/wiki.php';

if (!$_GET['wiki']) {
    header('Location: ../view/profil.php');
    die('errooor');
}
