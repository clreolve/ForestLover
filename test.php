<?php

include_once('./utilities.php');
include_once('./db/database_utilities.php');

$res = is_image_owner(11);
//$res = intval($res->ncomments);
debug($res);


?>