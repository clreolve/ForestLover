<?php
require_once('database_credentials.php');
$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
$result = '';

if ($mysqli->connect_errno) {
    echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}



function run_query()
{
	global $mysqli, $result;
	$sql = 'SELECT * FROM user';
	return $mysqli->query($sql);

}

// USER Functions

function get_user_by_id( $id )
{
	global $mysqli;
	$sql = "SELECT * FROM user WHERE id = {$id}";
	$result = $mysqli->query($sql);
	if($result->num_rows){
		return $result->fetch_assoc();
	}
	return false;
}

function get_user_data_by_email( $email )
{
	global $mysqli;
	$sql = "SELECT * FROM user WHERE email = '{$email}'";
	$result = $mysqli->query($sql);
	return $result->fetch_assoc();
}

function add_user( $email, $password )
{
	
	global $mysqli;
	$email_sanitized = filter_var($email, FILTER_SANITIZE_SPECIAL_CHARS);
	$password_sanitized = filter_var($password, FILTER_SANITIZE_SPECIAL_CHARS);
	$password_hash = password_hash($password_sanitized, PASSWORD_DEFAULT);
	
	try {
		$sql = "INSERT INTO user(id, email, password) VALUES (null, '{$email_sanitized}', '{$password_hash}')";
		$mysqli->query($sql);
	} catch (Exception $e) {
		$e->getMessage();
	}

	/*
	//el monstruo
	$sql = "INSERT INTO user(id, email, password) VALUES (null, '?', '?')";
	if (!($sentencia = $mysqli->prepare($sql))) {
		echo "Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error;
	}
	if (!$sentencia->bind_param("i", $id)) {
		echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
	}
	if (!$sentencia->bind_param("ss", $email_sanitized,$password_sanitized)) {
		echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
	}
	if (!$sentencia->execute()) {
		echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
	}
	//$result = $sentencia->get_result();
	$sentencia->close();
	*/
}

function update_user( $id, $email, $password )
{
	global $mysqli;
	$email_sanitized = filter_var($email, FILTER_SANITIZE_SPECIAL_CHARS);
	$id_sanitized = filter_var($id, FILTER_SANITIZE_SPECIAL_CHARS);
	$password_sanitized = filter_var($password, FILTER_SANITIZE_SPECIAL_CHARS);

	$sql = "UPDATE user SET email = '{$email_sanitized}', password = '{$password_sanitized}' WHERE id = {$id_sanitized}";
	$mysqli->query($sql);
}

function delete_user( $id )
{
	global $mysqli;

	$id_sanitized = filter_var($id, FILTER_SANITIZE_SPECIAL_CHARS);
	$sql = "DELETE FROM user WHERE id = {$id_sanitized}";
	$mysqli->query($sql);
}

function upload_images_home_page(){
	global $mysqli;

	$sql = "SELECT id_imagen FROM imagen ORDER BY id_imagen DESC";
	$result = $mysqli->query($sql);
	return $result->fetch_assoc();

}

function upload_image_popup($uid, $id_imagen){
	global $mysqli;

	$sql = 'SELECT user.email, user.id, imagen.link, imagen.fecha_publicacion FROM imagen INNER JOIN user on imagen.id_usuario = user.id WHERE imagen.id_imagen = {$id_imagen}'
	$sql1= 'SELECT COUNT(id_imagen_like) FROM imagen_like WHERE id_imagen = {$id_imagen}';
	$sql2 = 'SELECT id_imagen_like FROM imagen_like WHERE id_imagen = {$id_imagen} AND id_usuario = {$uid}';

}


	$sql_imagen = "SELECT user.email, user.id, imagen.descripcion, imagen.fecha_publicacion FROM imagen INNER JOIN user on imagen.id_usuario = user.id WHERE imagen.id_imagen = {$id_imagen};";
	$sql_likes = "SELECT COUNT(id_imagen_like) FROM imagen_like WHERE id_imagen = {$id_imagen};";
	$sql_me_gusta = "SELECT id_imagen_like FROM imagen_like WHERE id_imagen = {$id_imagen} AND id_usuario = {$uid};";

	$result_imagen = $mysqli->query($sql_imagen);
	$result_likes = $mysqli->query($sql_likes);
	$result_me_gusta = $mysqli->query($sql_me_gusta);

	$return = [];
	$return["imagen"] = $result_imagen->fetch_assoc();
	$return["numero_likes"] = $result_likes->fetch_assoc();
	$return["me_gusta"] =  $result_me_gusta->fetch_assoc();

	return $return;

}


/*
Especificación del tipo de caracteres para bind de variables
Carácter	Descripción
i	la variable correspondiente es de tipo entero
d	la variable correspondiente es de tipo double
s	la variable correspondiente es de tipo string
b	la variable correspondiente es un blob y se envía en paquetes
*/