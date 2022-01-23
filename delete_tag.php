<?php

include_once('./utilities.php');
include_once('./db/database_utilities.php');

if(!isset($_SESSION['uid'])){
    if(isset($_GET['tag']) && isset($_GET['id'])){
        $id_imagen = intval($_GET['id']);
        $id_tag = $_GET['tag'];
        if(is_image_owner($id_imagen)){
            delete_tag_image($id_imagen,$id_tag);
            echo json_encode(true);
            exit();
        }
    }
    
}
echo json_encode(false);