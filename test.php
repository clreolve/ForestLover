<?php

include_once('./utilities.php');
include_once('./db/database_utilities.php');

$res = get_user_by_id(6);
//$res = intval($res->ncomments);
debug($res['email']);

?>