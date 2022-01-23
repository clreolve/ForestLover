<?php

include_once('./dir_paths.php');
include_once('./utilities.php');
include_once('./db/database_utilities.php');


if (!isset($_GET['id'])) {
    header('location: ./error_page.php?id_error=303');
    exit();
}

$id_imagen = $_GET['id'];

$imagenes = '';
if (isset($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];
    $imagenes = json_decode(get_image_login($id_imagen, $uid));
} else {
    $imagenes = json_decode(get_image_not_login($id_imagen));
}

$ncoments = json_decode(n_comments($id_imagen));
$ncoments = intval($ncoments->ncomments);

debug($imagenes);

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

function get_ncomments($id_imagen)
{
    $res = json_decode(n_comments($id_imagen));
    $res = intval($res->ncomments);
    return $res;
}

?>


<!DOCTYPE html>
<html lang="es">
<?php include_once('./templates/header.php'); ?>

<body>
    <?php
    include_once('./templates/navbar.php');
    ?>

    <section>
        <div style="margin: 0 auto; background-color: black;">
            <div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-image">
                            <img class="materialboxed responsive-img" src="./view.php?id=<?php echo $id_imagen ?>">
                        </div>
                        <?php
                        $img = get_content($id_imagen);
                        $nlikes = $img->numero_likes->nlikes;
                        $descripcion = $img->imagen->descripcion;
                        $like = $img->imagen;

                        $username = $img->imagen->email;

                        ?>
                        <p><b class="teal-text">@<?php echo $username; ?></b> <?php echo $descripcion ?></p>
                    </div>

                    <nav class="barra-acciones-galeria teal darken-1">
                        <div>
                            <ul id="nav-mobile" class="left">
                                <?php
                                if (isset($_SESSION['uid'])) { ?>
                                    <li>
                                        <a>
                                            <button class="btn-flat" onclick="like(<?php echo $id_imagen ?>)">
                                                <i id="icon-like-<?php echo $id_imagen ?>" class="material-icons white-text">
                                                    <?php
                                                    if (is_like($id_imagen, intval($_SESSION['uid']))) {
                                                        echo 'favorite';
                                                    } else {
                                                        echo 'favorite_border';
                                                    }
                                                    ?>
                                                </i>
                                            </button>
                                        </a>
                                    </li>
                                <?php } ?>
                                <li>
                                    <a>
                                        <p id="n-like-<?php echo $id_imagen ?>"><?php echo $nlikes ?> likes</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="./post.php?id=<?php echo $id_imagen ?>">
                                        <p><?php echo get_ncomments($id_imagen); ?> Comentarios</p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>

                </div>
            </div>

        </div>
    </section>


</body>

<?php include_once('./templates/footer.php'); ?>



</html>