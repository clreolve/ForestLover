
<?php

if (!isset($_SESSION["uid"])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

if ($_POST) {
    if (isset($_POST["image"]) && isset($_POST["name"]) && isset($_POST["date"]) ) {
        $image = $_POST["image"];
        $name = $_POST["name"];
        $date = $_POST["date"];

        
    }
}

?>