<?php

include_once("./db/database_utilities.php");
include_once("./utilities.php");

if ($_POST) {

    if (isset($_POST["email"]) && isset($_POST["password"])) {
        //debug($_POST);
        $email = $_POST["email"];
        $password = $_POST["password"];
        //debug($email);
        //debug($password);

        add_user($email,$password);
        header("location: perfil.php");
    }
    
}else{
    header('location: index.php');
}
