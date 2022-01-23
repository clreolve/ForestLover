<?php
include_once('./dir_paths.php');
include_once('./utilities.php');
include_once('./db/database_utilities.php');

// GET
// tag=[numero idtag] buscar imagenes con ese tag $_GET['tag']
// text = "texto a buscar" match descripcion $_GET['text']
// specie = buscar imagenes de ese especie
// forest = buscar para idbosque

function search(){
    if($_GET){
        if(isset($_GET['tag'])){

        }else if(isset($_GET['text'])){

        }else if(isset($_GET['specie'])){

        }else if(isset($_GET['forest'])){
            
        }
    }
    return NULL;
}


?>