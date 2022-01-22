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

            if(is_like($id_imagen,$uid)){
                remove_like_image($id_imagen,$uid);
                $response['islike'] = false;
            }else{
                like_image($id_imagen,$uid);
                $response['islike'] = true;
            }
            $response['nlikes'] = n_likes($id_imagen);
            echo json_encode($response);
        }
    }
}


