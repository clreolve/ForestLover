<?php

include_once('./dir_paths.php');

/**
 *  @param string $new_title Nuevo titulo de la pagina
 */
function update_title($new_title) {
	echo "<script>";
	echo "$('title').html('{$new_title}');";
	echo "</script>";
}


?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src=" <?php echo JQUERY_PATH ; ?> "></script>
</head>
<body>
    
