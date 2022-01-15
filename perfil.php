<?php
include_once('utilities.php');
?>

<!DOCTYPE html>
<html lang="es">

<?php include_once("./templates/header.php") ?>

<body>
    <p>
        Hola <?php echo isset($_SESSION["uid"]) ? $_SESSION["uid"] : "Desconocido"; ?>
    </p>
</body>

<?php include_once("./templates/footer.php") ?>

</html>