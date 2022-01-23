<?php
include_once("./db/database_utilities.php");
include_once("./utilities.php");

$message = 'Deja de Jugar con los mensajes de Error';
$message_button = 'Vete de aki vandalo';
$redireccion = './galeria.php';


if (isset($_GET["id_error"])) {
    switch ($_GET["id_error"]) {
        case 101:
            $message = 'Datos Incorrectos verifica los datos que ingresastes';
            $message_button = 'Iniciar Sesion/Registrarse';
            $redireccion = './login.php';
            break;
        case 202:
            $message = 'Ha ocurrido un error al subir la imagen';
            $message_button = 'Pagina Principal';
            $redireccion = './index.php';
            break;
        default:
            $message = 'Deja de Jugar con los mensajes de Error';
            $message_button = 'Vete de aki vandalo';
            $redireccion = './galeria.php';
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="es">


<?php include_once('./templates/header.php'); ?>


<body>
    <?php include_once('./templates/navbar.php'); ?>
    <h2>Algo Salio Mal UmU !!!</h2>
    <h3><?php echo $message ?></h3>
    <a class="waves-effect waves-light btn" href="<?php echo $redireccion ?>"><?php echo $message_button ?></a>
    <br>
    <img src="./resources/loli.jpg">

    <?php
    include_once('./templates/footer.php');
    ?>
</body>

</html>