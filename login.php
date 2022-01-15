<?php
include_once('utilities.php');
include_once('db/database_utilities.php');

if( $_POST ){
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $password = isset($_POST['password']) ? $_POST['password'] : '';

  $user_data = get_user_data_by_email($email);
  
  if (password_verify($password, $user_data['password'])) {
    $_SESSION['uid'] = $user_data['id'];
    header('location: perfil.php');
    die();
  } else {
    die('datos incorrectos');
  }
  
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include_once("./templates/header.php") ?>

<body>

  <form action="./login.php" method="POST">
    <input type="text" name="email" id="email" placeholder="Correo">
    <input type="text" name="password" id="password" placeholder="Contraseña">
    <input type="submit" value="Login">
  </form>

  <form action="./adduser.php" method="POST">
    <input type="text" name="email" id="email" placeholder="Correo">
    <input type="text" name="password" id="password" placeholder="Contraseña">
    <input type="submit" value="Agregar Usuario">
  </form>
    
</body>

<?php include_once("./templates/footer.php"); ?>

</html>