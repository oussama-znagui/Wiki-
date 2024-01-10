<?php
if (!$_POST) {
    header('Location: ../view/index.php');
}
session_start();


include '../config/connexion.php';
include '../model/user.php';
