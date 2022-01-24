<?php
include_once('./dir_paths.php');
include_once('./utilities.php');
include_once('./db/database_utilities.php');

// GET
// tag=[numero idtag] buscar imagenes con ese tag $_GET['tag']
// text = "texto a buscar" match descripcion $_GET['text']
// specie = buscar imagenes de ese especie
// forest = buscar para idbosque
function search()
{
    if ($_GET) {
        if (isset($_GET['tag'])) {

            $id_etiqueta = intval($_GET['tag']);
            return json_decode(get_image_tags($id_etiqueta));

        } else if (isset($_GET['text'])) {
<<<<<<< Updated upstream
=======
            
            if (!isset($_GET['page'])) {
                header("location: ./buscar.php?page=1&text={$_GET['text']}");
                exit();
            }
>>>>>>> Stashed changes

            $ntexto = $_GET['text'];

            return json_decode(get_commits_by_text($ntexto));

        } else if (isset($_GET['specie'])) {

            $id_specie = intval($_GET['specie']);
            return json_decode(get_image_species($id_specie));

        } else if (isset($_GET['forest'])) {

            $id_bosque = intval($_GET['forest']);
            return json_decode(get_image_bosque($id_bosque));
        }
    }
    return [];
}

/*function matchText($texto){
    if($_GET){
        if(isset($_GET[$texto])){
            $ntexto = strval($_GET[$texto]);
            return json_decode(get_commits_by_text($ntexto));
        }
    }  
    return [];
}
**/

debug(search());