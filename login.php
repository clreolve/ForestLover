<?php
include_once('utilities.php');
include_once('db/database_utilities.php');
set_title('Inicie Sesión o Registrese');

if(isset($_SESSION['uid'])){
  header('location: ./galeria.php');
  exit();
}

if ($_POST) {
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $password = isset($_POST['password']) ? $_POST['password'] : '';

  $user_data = json_decode(get_user_data_by_email($email));

  if (password_verify($password, $user_data->password)) {
    $_SESSION['uid'] = $user_data->id;
    header('location: galeria.php');
    die();
  } else {
    header('location: ./error_page.php?id_error=101');
    die();
  }
}

?>

<!DOCTYPE html>
<html lang="es">

<?php include_once("./templates/header.php") ?>

<body>
  <?php include_once('./templates/navbar.php'); ?>

  <h2>Hola, Bienvenido a Forest Lover</h2>

  <section class="row">
    <div class="card col s12 m6">
      <h4>Inicie Sesion</h4>
      <form action="./login.php" method="POST">

        <label>Correo</label>
        <input type="text" name="email" id="email">

        <label>Contraseña</label>
        <input type="password" name="password" id="password">
        <button class="btn waves-effect waves-light" type="submit" name="action">Entrar
    <i class="material-icons right">send</i>
  </button>
      </form>

    </div>

    <div class="card col s12 m6">

      <h4>Registrese</h4>

      <form action="./adduser.php" method="POST">

        <label>Correo</label>
        <input type="text" name="email" id="email">

        <label>Contraseña</label>
        <input type="password" name="password" id="password">

        <button class="btn waves-effect waves-light" type="submit">Agregar Usuario
    <i class="material-icons right">send</i>
  </button>
      </form>

    </div>

  </section>

</body>

<?php include_once("./templates/footer.php"); ?>







</html>