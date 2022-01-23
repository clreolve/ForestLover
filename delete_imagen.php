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

            $res = get_image_login($id_imagen, $uid);
            $res = json_decode($res);
            $res = $res->imagen;
            $res = $res->email;

            $username =get_user_by_id($uid);
            $username = $username['email'];

            if($username == $res){
                delete_image($id_imagen);
                echo json_encode("imagen eliminada");
            }else{
                echo json_encode("imagen no eliminada");
                header('location: ./error_page?id_error=505');
            }
            
        }
    }
}


