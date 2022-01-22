<?php

include_once('./utilities.php');
include_once('./db/database_utilities.php');

$test = get_user_data_by_email("uwu");
$test = json_decode($test);
debug($test->password);

?>