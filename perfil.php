<?php
include_once('utilities.php');
?>

<!DOCTYPE html>
<html lang="es">

<?php include_once("./templates/header.php") ?>

<body>
    <p> Hola usuario con indice <?php echo isset($_SESSION["uid"]) ? $_SESSION["uid"] : "Desconocido"; ?> </p>

    <?php if (isset($_SESSION["uid"])) { ?>

        <form method="post" action="upload.image.php" enctype="multipart/form-data">

            <div>
                <label>Descripcion</label>
                <input type="text" name="descripcion" id="descripcion">
            </div>

            <h4>Seleccione imagen a cargar</h4>
            <div>
                <label>Archivos</label>
                <div>
                    <input type="file" id="file" name="file" multiple>
                </div>
                <button name="submit">Cargar Imagen</button>
            </div>


        </form>

    <?php } ?>
</body>

<?php include_once("./templates/footer.php") ?>

</html>