<?php


include_once('./dir_paths.php');
include_once('./utilities.php');
include_once('./db/database_utilities.php');

if (isset($_SESSION['uid'])) {
    if (isset($_POST)) {
        if (isset($_POST['text'])) {
            if ($_POST['text'] == '') {
                $id_usuario = intval($_SESSION['uid']);
                $texto = $_POST['text'];
                $id_imagen = intval($_POST['id_imagen']);
                add_comentario($id_usuario, $texto, $id_imagen);
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }
        }
    }
}else{
    header("location: ./error_page.php?id_error=101");
}

header('Location: ' . $_SERVER['HTTP_REFERER']);