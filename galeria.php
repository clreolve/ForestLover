<?php
include_once('./dir_paths.php');
include_once('./utilities.php');
include_once('./db/database_utilities.php');

set_title('Galeria');
?>

<!DOCTYPE html>
<html lang="es">
<?php include_once('./templates/header.php'); ?>

<body>
    <?php
    include_once('./templates/navbar.php');
    $images = json_decode(get_last_images());
    $images_info = [];

    if (isset($_SESSION['uid'])) {
        $uid = $_SESSION['uid'];
        foreach ($images as $key => $value) {
            $id_imagen = intval($value->id_imagen);
            $imagenes = json_decode(get_image_login($id_imagen, $uid));
            array_push($images_info,json_decode(get_image_login($id_imagen, $uid)));
        }
    } else {
        foreach ($images as $key => $value) {
            $id_imagen = intval($value->id_imagen);
            $imagenes = json_decode(get_image_not_login($id_imagen));
            array_push($images_info,json_decode(get_image_not_login($id_imagen)));
        }
    }


    ?>

<div>
    <?php
    foreach ($images as $key => $value) {
        $id_imagen = intval($value->id_imagen);
    ?>
        <img src="./view.php?id=<?php echo $id_imagen ?>">
    <?php } ?>
</div>



</body>

<?php include_once('./templates/footer.php');?>

</html>