<?php
// ESTO NO SE TOCA

include_once('./utilities.php');
include_once('./db/database_utilities.php');

if (!empty($_GET['id'])) {
    global $mysqli;
    $sql = "SELECT * FROM imagen WHERE id_imagen = {$_GET['id']}";
    $result = $mysqli->query($sql);

    header('Content-type: image/jpg');

    while ($row = $result->fetch_assoc()) {
        echo $row['file'];
    }

};
