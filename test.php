<?php

include_once('./utilities.php');
include_once('./db/database_utilities.php');

$res = json_decode(get_last_images());
//$res = intval($res->ncomments);
debug($res);

function search(){
    
}

?>