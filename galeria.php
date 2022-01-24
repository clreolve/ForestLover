<?php
include_once('./dir_paths.php');
include_once('./utilities.php');
include_once('./db/database_utilities.php');

set_title('Galeria');

//PAGINACION
if (!isset($_GET['page'])) {
    header("location: ./galeria.php?page=1");
    exit();
}

$images_all = json_decode(get_last_images());
$images_info = [];

$numero_imagenes = sizeof($images_all);
$max_por_pagina = isset($_GET['nimg']) ? $_GET['nimg'] : 10;
$page = $_GET['page'];

$index_inicial = ($page - 1) * $max_por_pagina;
$index_final = $page * $max_por_pagina;
$images = array_slice($images_all, $index_inicial, $index_final);

$is_previus_page = $page > 1 ? true : false;
$is_next_page = $index_final < $numero_imagenes ? true : false;
//
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
        <div class="row s12 m12">
            <!-- Div de las Imagenes-->
            <div class="col s12 m8">
                <?php
                foreach ($images as $key => $value) {
                    $id_imagen = intval($value->id_imagen);
                    $img = get_content($id_imagen);
                    $nlikes = $img->numero_likes->nlikes;
                    $descripcion = $img->imagen->descripcion;
                    $like = $img->imagen;
                    $fecha_publicacion = $img->imagen->fecha_publicacion;

                    $fecha_publicacion = fecha($fecha_publicacion);

                    $username = $img->imagen->email;
                ?>

                    <div style="margin: 0 auto; background-color: black;">
                        <div>
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-image">
                                        <img class="materialboxed responsive-img" src="./view.php?id=<?php echo $id_imagen ?>">
                                    </div>
                                    <p><b class="teal-text"><?php echo $fecha_publicacion; ?></b></p>
                                    <p><b class="teal-text">@<?php echo $username; ?></b> <?php echo $descripcion ?></p>
                                </div>

                                <nav class="barra-acciones-galeria teal darken-1">
                                    <div>
                                        <ul id="nav-mobile" class="left">
                                            <?php
                                            // Likes para usuarios Logeados
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
                                            <?php
                                            //eliminar imagen
                                            if (is_image_owner($id_imagen)) {
                                                //
                                            ?>
                                                <li>
                                                    <a>
                                                        <button class="btn-flat" onclick="delete_img(<?php echo $id_imagen ?>)">
                                                            <i id="icon-like-<?php echo $id_imagen ?>" class="material-icons white-text">
                                                                delete
                                                            </i>
                                                        </button>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </nav>

                            </div>
                        </div>

                    </div>
                <?php } ?>

                <?php
                //$is_previus_page && $is_next_page
                if ($is_next_page && $is_previus_page) { ?>
                    <nav>
                        <div class="nav-wrapper teal darken-1">
                            <ul id="nav-mobile teal darken-1" class="right">
                                <li><a href="./galeria.php?page=<?php echo $page - 1 ?>">
                                        Anterior</a></li>
                                <li><a href="./galeria.php?page=<?php echo $page + 1 ?>">Siguiente</a></li>
                            </ul>
                        </div>
                    </nav>
                <?php
                } else if ($is_previus_page) { ?>
                    <nav>
                        <div class="nav-wrapper teal darken-1">
                            <ul id="nav-mobile teal darken-1" class="right">
                                <li><a href="./galeria.php?page=<?php echo $page - 1 ?>">Anterior</a></li>
                            </ul>
                        </div>
                    </nav>
                <?php } else if ($is_next_page) { ?>
                    <nav>
                        <div class="nav-wrapper teal darken-1">
                            <ul id="nav-mobile teal darken-1" class="right">
                                <li><a href="./galeria.php?page=<?php echo $page + 1 ?>">Siguiente</a></li>
                            </ul>
                        </div>
                    </nav>
                <?php } ?>
            </div>

            <!-- Div de Derecho-->
            <div class="col s12 m4">

                <!-- Div de Cargar Imagenes-->
                <div class="card">
                    <?php if (isset($_SESSION['uid'])) {
                        include_once('./templates/cargar_imagen.php');
                    } ?>
                </div>
            </div>

        </div>

    </section>

</body>

<?php include_once('./templates/footer.php'); ?>

</html>