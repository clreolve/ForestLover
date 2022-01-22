<?php

include_once("./utilities.php");
include_once("./db/database_utilities.php");

if (!isset($_SESSION["uid"])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

debug($_FILES);
debug($_POST);


if (isset($_POST["submit"])) {
    $revisar = getimagesize($_FILES["file"]["tmp_name"]);
    if ($revisar !== false) {
        $image = $_FILES['file']['tmp_name'];

        $file = addslashes(file_get_contents($image));

        debug($_FILES['file']["type"]);

        $uid = $_SESSION["uid"];
        $descripcion = $_POST["descripcion"];

        global $mysqli;


        $sql = "INSERT INTO imagen(id_imagen, fecha_publicacion, file, id_usuario, descripcion) 
            VALUES (NULL, current_timestamp(),'{$file}',{$uid},'{$descripcion}');";

        $insertar = $mysqli->query($sql);        
        
        if($insertar){
            echo "Archivo Subido Correctamente.";
        }else{
            echo "Ha fallado la subida, reintente nuevamente.";
        }
    } else {
        echo "Por favor seleccione imagen a subir.";
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();

}
