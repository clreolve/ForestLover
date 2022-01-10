<?php
include_once('utilities.php');
include_once('db/database_utilities.php');

if( $_POST ){
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $password = isset($_POST['password']) ? $_POST['password'] : '';

  $user_data = get_user_data_by_email($email);

  if (password_verify($password, $user_data['password'])) {
    $_SESSION['uid'] = $user_data['id'];
    header('location: restricted.php');
    die();
  } else {
    die('datos incorrectos');
  }
  
}
