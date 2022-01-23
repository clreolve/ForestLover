<?php

include_once("./db/database_utilities.php");
include_once("./utilities.php");


if(!isset($_GET['id'])){
    header('location: ./error_page.php?id_error=303');
    exit();
}

$id_imagen = $_GET['id'];

$imagenes = '';
if (isset($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];
    $imagenes = json_decode(get_image_login($id_imagen, $uid));
} else {
    $imagenes = json_decode(get_image_not_login($id_imagen));
}

$ncoments = json_decode(n_comments($id_imagen));
$ncoments = intval($ncoments->ncomments);

debug($imagenes);