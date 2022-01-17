<?php
include_once('./dir_paths.php');
include_once('./utilities.php');
include_once('./db/database_utilities.php')
?>

<!DOCTYPE html>
<html lang="en">
<?php include_once('./templates/header.php'); ?>

<body>

    <table>
        <tr>
            <th>id</th>
            <th>descripcion</th>
            <th>imagen</th>
        </tr>
        <?php 
        
        foreach(get_last_images() as $key => $valor){ 
            $info = get_image_not_login( $valor["id_imagen"]);
            ?>
            <tr>
                <td><?php echo $valor["id_imagen"] ?></td>
                <td><?php echo $info["imagen"]["descripcion"] ?></td>
                <td> <img src="./view.php?id=<?php echo $valor["id_imagen"]; ?>" width="400"> </td>
            </tr>
        <?php } ?>
    </table>
    
</body>

<?php include_once('./templates/footer.php'); ?>

</html>