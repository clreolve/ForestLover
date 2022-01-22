<?php
include_once('./dir_paths.php');
include_once('./utilities.php');
include_once('./db/database_utilities.php');

set_title('Galeria');

function get_content($id_imagen)
{
    if (isset($_SESSION['uid'])) {
        $uid = $_SESSION['uid'];
        $imagenes = json_decode(get_image_login($id_imagen, $uid));
    } else {
        $imagenes = json_decode(get_image_not_login($id_imagen));
    }
    return $imagenes;
}

if($_POST){
    //post
}
?>

<!DOCTYPE html>
<html lang="es">
<?php include_once('./templates/header.php'); ?>

<body>
    <?php
    include_once('./templates/navbar.php');
    $images = json_decode(get_last_images());
    $images_info = [];


    ?>

    <section>


        <div class="row s12 m12">
            <div class="col s12 m8">
                <?php
                foreach ($images as $key => $value) {
                    $id_imagen = intval($value->id_imagen);
                ?>

                    <div style="margin: 0 auto; background-color: black;">
                        <div>
                            <div class="card green">
                                <div class="card-content">
                                    <div class="card-image">
                                        <img src="./view.php?id=<?php echo $id_imagen ?>">
                                    </div>
                                    <?php
                                    $img = get_content($id_imagen);
                                    $nlikes = $img->numero_likes->nlikes;
                                    $descripcion = $img->imagen->descripcion;
                                    $like = $img->imagen;

                                    ?>
                                    <p><?php echo $descripcion ?></p>
                                </div>
                                <div class="card-action">
                                    <a href="#">Comentarios</a>
                                    <p id="n-like-<?php echo $id_imagen ?>"><?php echo $nlikes ?> likes</p>
                                    <?php
                                    if (isset($_SESSION['uid'])) { ?>
                                        <button class="waves-effect waves-teal btn-flat" onclick="like(<?php echo $id_imagen?>)">
                                            <i id="icon-like-<?php echo $id_imagen ?>" class="material-icons">
                                            <?php 
                                            if(is_like($id_imagen,intval($_SESSION['uid']))){
                                                echo 'favorite';
                                            }else{
                                                echo 'favorite_border';
                                            }
                                            ?>
                                            </i>
                                        </button>
                                    <?php } ?>

                                </div>

                            </div>
                        </div>

                    </div>
                <?php } ?>
            </div>

            <div class="col s12 m4" style="background-color: yellow; height: 600px;">
            </div>

        </div>

    </section>



</body>

<?php include_once('./templates/footer.php'); ?>



</html>