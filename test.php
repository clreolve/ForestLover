<?php

include_once('./utilities.php');
include_once('./db/database_utilities.php');

$res = is_owner_image(11,7);
//$res = intval($res->ncomments);
debug($res);

?>