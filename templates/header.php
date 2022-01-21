<?php
$actualTitle = isset($_COOKIE['title']) ? $_COOKIE['title'] : "Forest Lover";
?>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo $actualTitle; ?> </title>

    <script src=" ./js/jquery-3.6.0.min.js "></script>
    <script src="./js/materialize.min.js"></script>
    <script src="./js/script.js"></script>

    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>