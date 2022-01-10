<?php

include_once('./utilities.php');

include_once('./templates/header.php');


$arr = [];

$arr["name"] = "proyecto";
$arr["peso"] = 70;
$arr["hetero"] = true;

debug($arr);

include_once('./templates/footer.php');