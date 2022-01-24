<?php

include_once('./utilities.php');
include_once('./db/database_utilities.php');


if (isset($_SESSION['uid'])) {

    if (isset($_GET['tag']) & isset($_GET['id'])) {

        $id_imagen = intval($_GET['id']);
        $id_tag = intval($_GET['tag']);
        $uid = intval($_SESSION['uid']);
        debug($id_imagen);
        if (is_image_owner($id_imagen)) {
            delete_tag_image($id_tag, $id_imagen);
            echo json_encode(true);
            exit();
        }
    }
    //borrado
}

echo json_encode(false);
exit();
