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
            <td>id</td>
            <td>descripcion</td>
            <td>imagen</td>
        </tr>
        <?php 
        $r = get_last_images();
        debug($r);
        ?>
    </table>
    
</body>

<?php include_once('./templates/footer.php'); ?>

</html>