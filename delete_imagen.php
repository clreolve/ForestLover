<?php
include_once('./dir_paths.php');
include_once('./utilities.php');
include_once('./db/database_utilities.php');

if ($_SESSION['uid']) {
    if ($_POST) {
        if (isset($_POST['id_imagen'])) 
        {
            $response = [];
            
            $id_imagen = intval($_POST['id_imagen']);
            $uid = intval($_SESSION['uid']);

            if(is_owner_image($id_imagen,$uid)){
                delete_image($id_imagen);
                echo json_encode("imagen eliminada");
            }else{
                echo json_encode("imagen no eliminada");
                header('location: ./error_page?id_error=505');
            }
            
        }
    }
}


