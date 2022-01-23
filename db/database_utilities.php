<?php
require_once('database_credentials.php');
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
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
function get_user_by_id($id)
{
	global $mysqli;
	$sql = "SELECT * FROM user WHERE id = {$id}";
	$result = $mysqli->query($sql);
	if ($result->num_rows) {
		return $result->fetch_assoc();
	}
	return false;
}

function get_user_data_by_email($email)
{
	global $mysqli;
	$sql = "SELECT * FROM user WHERE email = '{$email}'";
	$result = $mysqli->query($sql);
	return json_encode($result->fetch_assoc());
}

function add_user($email, $password)
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
}

function update_user($id, $email, $password)
{
	global $mysqli;
	$email_sanitized = filter_var($email, FILTER_SANITIZE_SPECIAL_CHARS);
	$id_sanitized = filter_var($id, FILTER_SANITIZE_SPECIAL_CHARS);
	$password_sanitized = filter_var($password, FILTER_SANITIZE_SPECIAL_CHARS);

	$sql = "UPDATE user SET email = '{$email_sanitized}', password = '{$password_sanitized}' WHERE id = {$id_sanitized}";
	$mysqli->query($sql);
}

function delete_user($id)
{
	global $mysqli;

	$id_sanitized = filter_var($id, FILTER_SANITIZE_SPECIAL_CHARS);
	$sql = "DELETE FROM user WHERE id = {$id_sanitized}";
	$mysqli->query($sql);
}

## Home
/**
 * () -> lista[id_imagen descendeteporfecha];
 */
function get_last_images()
{
	global $mysqli;

	$sql = "SELECT id_imagen FROM imagen ORDER BY id_imagen DESC";
	$result = $mysqli->query($sql);

	$return = [];
	while ($e = $result->fetch_assoc()) {
		array_push($return, $e);
	}

	return json_encode($return);
}


/**(uid, id_imagen) => [
  fecha de publicacion, 
  descripcion,
  numero me gustas (count), 
  me gusta(bool),
  id usuario al que pertenece,
  nombre usuario al que pertenece
]
 */
function is_like($id_imagen, $uid){
	global $mysqli;

	$sql_me_gusta = "SELECT id_imagen_like FROM imagen_like WHERE id_imagen = {$id_imagen} AND id_usuario = {$uid};";
	$result_me_gusta = $mysqli->query($sql_me_gusta);
	$mylike =  $result_me_gusta->fetch_assoc();
	return $mylike == NULL ? false : true;
}

function n_likes($id_imagen){
	global $mysqli;

	$sql_likes = "SELECT COUNT(id_imagen_like) AS nlikes FROM imagen_like WHERE id_imagen = {$id_imagen};";
	$result_likes = $mysqli->query($sql_likes);
	$return= $result_likes->fetch_assoc();

	return json_encode($return);

}

function n_comments($id_imagen)
{
	global $mysqli;

	$sql = "SELECT count(comentario.id_comentario) AS ncomments FROM comentario INNER JOIN user ON comentario.id_usuario = user.id WHERE comentario.id_imagen = {$id_imagen}";
	$result = $mysqli->query($sql);

	$return = $result->fetch_assoc();

	return json_encode($return);
}

function get_image_login($id_imagen, $uid)
{
	global $mysqli;

	$sql_imagen = "SELECT user.email, user.id, imagen.descripcion, imagen.fecha_publicacion FROM imagen INNER JOIN user on imagen.id_usuario = user.id WHERE imagen.id_imagen = {$id_imagen};";
	$sql_likes = "SELECT COUNT(id_imagen_like) AS nlikes FROM imagen_like WHERE id_imagen = {$id_imagen};";
	$sql_me_gusta = "SELECT id_imagen_like FROM imagen_like WHERE id_imagen = {$id_imagen} AND id_usuario = {$uid};";

	$result_imagen = $mysqli->query($sql_imagen);
	$result_likes = $mysqli->query($sql_likes);
	$result_me_gusta = $mysqli->query($sql_me_gusta);

	$return = [];
	$return["imagen"] = $result_imagen->fetch_assoc();
	$return["numero_likes"] = $result_likes->fetch_assoc();

	$mylike =  $result_me_gusta->fetch_assoc();
	$return["me_gusta"] = $mylike == NULL ? false : true;

	return json_encode($return);
}


function get_image_not_login($id_imagen)
{
	global $mysqli;

	$sql_imagen = "SELECT user.email, user.id, imagen.descripcion, imagen.fecha_publicacion FROM imagen INNER JOIN user on imagen.id_usuario = user.id WHERE imagen.id_imagen = {$id_imagen};";
	$sql_likes = "SELECT COUNT(id_imagen_like) AS nlikes FROM imagen_like WHERE id_imagen = {$id_imagen};";


	$result_imagen = $mysqli->query($sql_imagen);
	$result_likes = $mysqli->query($sql_likes);


	$return = [];
	$return["imagen"] = $result_imagen->fetch_assoc();
	$return["numero_likes"] = $result_likes->fetch_assoc();


	return json_encode($return);
}

function image_comments($id_imagen)
{
	global $mysqli;

	$sql = "SELECT comentario.id_comentario, comentario.texto, comentario.id_usuario, user.email FROM comentario INNER JOIN user ON comentario.id_usuario = user.id WHERE comentario.id_imagen = {$id_imagen}";
	$result = $mysqli->query($sql);

	$return = [];
	while ($e = $result->fetch_assoc()) {
		array_push($return, $e);
	}

	return json_encode($return);
}

function image_tags($id_imagen)
{
	global $mysqli;

	$sql = "SELECT etiqueta_imagen.id_etiqueta, etiqueta.nombre FROM etiqueta_imagen INNER JOIN etiqueta ON etiqueta_imagen.id_etiqueta = etiqueta.id_etiqueta WHERE etiqueta_imagen.id_imagen = {$id_imagen}";
	$result = $mysqli->query($sql);

	$return = [];
	while ($e = $result->fetch_assoc()) {
		array_push($return, $e);
	}

	return json_encode($return);
}

function species_tags($id_especie)
{
	global $mysqli;

	$sql = " SELECT especie.id_especie , especie.nombre FROM especie INNER JOIN imagen_especie ON especie.id_especie = imagen_especie.id_especie WHERE imagen_especie.id_imagen = {$id_especie}";
	$result = $mysqli->query($sql);

	$return = [];
	while ($e = $result->fetch_assoc()) {
		array_push($return, $e);
	}

	return json_encode($return);
}

## pagina bosque

function get_forest_login($id_bosque, $uid)
{
	global $mysqli;

	$sql_bosque = "SELECT nombre, descripción FROM bosque WHERE id_bosque = {$id_bosque};";
	$sql_likes = "SELECT COUNT(id_bosque_like) FROM bosque_like WHERE id_bosque = {$id_bosque};";
	$sql_me_gusta = "SELECT id_bosque_like FROM bosque_like WHERE id_bosque = {$id_bosque} AND id_usuario = {$uid};";

	$result_bosque = $mysqli->query($sql_bosque);
	$result_likes = $mysqli->query($sql_likes);
	$result_me_gusta = $mysqli->query($sql_me_gusta);

	$return = [];
	$return["bosque"] = $result_bosque->fetch_assoc();
	$return["numero_likes"] = $result_likes->fetch_assoc();

	$mylike =  $result_me_gusta->fetch_assoc();
	$return["me_gusta"] = $mylike == NULL ? false : true;

	return json_encode($return);
}

function get_forest_not_login($id_bosque)
{
	global $mysqli;

	$sql_bosque = "SELECT nombre, descripción FROM bosque WHERE id_bosque = {$id_bosque};";
	$sql_likes = "SELECT COUNT(id_bosque_like) FROM bosque_like WHERE id_bosque = {$id_bosque};";

	$result_bosque = $mysqli->query($sql_bosque);
	$result_likes = $mysqli->query($sql_likes);

	$return = [];
	$return["bosque"] = $result_bosque->fetch_assoc();
	$return["numero_likes"] = $result_likes->fetch_assoc();

	return json_encode($return);
}

function forest_species($id_bosque)
{
	global $mysqli;

	$sql = "SELECT bosque_especie.id_especie, especie.nombre FROM bosque_especie INNER JOIN especie ON bosque_especie.id_especie = especie.id_especie WHERE bosque_especie.id_bosque= {$id_bosque};";
	$result = $mysqli->query($sql);

	$return = [];
	while ($e = $result->fetch_assoc()) {
		array_push($return, $e);
	}

	return json_encode($return);
}

function forest_tags($id_bosque)
{

	global $mysqli;

	$sql = "SELECT bosque_etiqueta.id_bosque_etiqueta, etiqueta.nombre FROM bosque_etiqueta INNER JOIN etiqueta ON bosque_etiqueta.id_etiqueta = etiqueta.id_etiqueta WHERE bosque_etiqueta.id_bosque = {$id_bosque};";
	$result = $mysqli->query($sql);

	$return = [];
	while ($e = $result->fetch_assoc()) {
		array_push($return, $e);
	}

	return json_encode($return);
}

function get_forest_image($id_bosque)
{

	global $mysqli;

	$sql = "SELECT id_imagen FROM bosque_imagen WHERE id_bosque = {$id_bosque} ORDER BY id_imagen DESC;";
	$result = $mysqli->query($sql);

	$return = [];
	while ($e = $result->fetch_assoc()) {
		array_push($return, $e);
	}

	return json_encode($return);
}

## adicionales

function get_image_tags($id_etiqueta)
{

	global $mysqli;

	$sql = "SELECT id_imagen FROM etiqueta_imagen WHERE id_etiqueta = {$id_etiqueta} GROUP BY id_imagen DESC;";
	$result = $mysqli->query($sql);

	$return = [];
	while ($e = $result->fetch_assoc()) {
		array_push($return, $e);
	}

	return json_encode($return);
}
function get_image_species($id_especie)
{

	global $mysqli;

	$sql = "SELECT id_imagen FROM imagen_especie WHERE id_especie = {$id_especie} ORDER BY id_imagen DESC;";
	$result = $mysqli->query($sql);

	$return = [];
	while ($e = $result->fetch_assoc()) {
		array_push($return, $e);
	}

	return json_encode($return);
}

//Claudio Olvera

function delete_image($id_bosque)
{
	global $mysqli;

	$id_bosque = filter_var($id_bosque, FILTER_SANITIZE_SPECIAL_CHARS);
	$sql = "DELETE FROM imagen WHERE id_imagen = {$id_bosque};";
	$mysqli->query($sql);
}

function create_tag($nombre)
{
	global $mysqli;

	$nombre = filter_var($nombre, FILTER_SANITIZE_SPECIAL_CHARS);
	$sql = "INSERT INTO etiqueta(nombre) VALUES ({$nombre});";
	$mysqli->query($sql);
}

function delete_tag($id_usuario)
{
	global $mysqli;

	$id_usuario = filter_var($id_usuario, FILTER_SANITIZE_SPECIAL_CHARS);
	$sql = "DELETE FROM etiqueta WHERE id_usuario = {$id_usuario};";
	$mysqli->query($sql);
}

function give_tag_forest($id_bosque, $id_usuario)
{
	global $mysqli;

	$id_usuario = filter_var($id_usuario, FILTER_SANITIZE_SPECIAL_CHARS);
	$id_bosque = filter_var($id_bosque, FILTER_SANITIZE_SPECIAL_CHARS);
	$sql = "INSERT INTO bosque_etiqueta(id_bosque, id_usuario) VALUES ({$id_bosque},{$id_usuario});";
	$mysqli->query($sql);
}

function give_tag_image($id_bosque, $id_usuarios)
{
	global $mysqli;

	$id_usuarios = filter_var($id_usuarios, FILTER_SANITIZE_SPECIAL_CHARS);
	$id_bosque = filter_var($id_bosque, FILTER_SANITIZE_SPECIAL_CHARS);
	$sql = "INSERT INTO etiqueta_imagen (id_usuario, id_bosque) VALUES ({$id_usuarios},{$id_bosque});";
	$mysqli->query($sql);
}

function give_tag_spice($id_bosque, $id_usuario)
{
	global $mysqli;

	$id_usuario = filter_var($id_usuario, FILTER_SANITIZE_SPECIAL_CHARS);
	$id_bosque = filter_var($id_bosque, FILTER_SANITIZE_SPECIAL_CHARS);
	$sql = "INSERT INTO etiqueta_especie (id_usuario, id_bosque) VALUES ({$id_usuario},{$id_bosque});";
	$mysqli->query($sql);
}

function delete_tag_forest($id_bosque, $id_usuario)
{
	global $mysqli;

	$id_bosque = filter_var($id_bosque, FILTER_SANITIZE_SPECIAL_CHARS);
	$id_usuario = filter_var($id_usuario, FILTER_SANITIZE_SPECIAL_CHARS);
	$sql = "DELETE FROM bosque_etiqueta WHERE id_bosque = {$id_bosque} AND id_usuario{$id_usuario};";
	$mysqli->query($sql);
}

function delete_tag_image($id_bosque, $id_usuario)
{
	global $mysqli;

	$id_bosque = filter_var($id_bosque, FILTER_SANITIZE_SPECIAL_CHARS);
	$id_usuario = filter_var($id_usuario, FILTER_SANITIZE_SPECIAL_CHARS);
	$sql = "DELETE FROM etiqueta_imagen WHERE id_usuario = {$id_usuario} AND id_bosque{$id_bosque};";
	$mysqli->query($sql);
}

function delete_tag_species($id_bosque, $id_usuario)
{
	global $mysqli;

	$id_bosque = filter_var($id_bosque, FILTER_SANITIZE_SPECIAL_CHARS);
	$id_usuario = filter_var($id_usuario, FILTER_SANITIZE_SPECIAL_CHARS);
	$sql = "DELETE FROM etiqueta_especie WHERE id_usuario = {$id_usuario} AND id_bosque{$id_bosque};";
	$mysqli->query($sql);
}

function add_comentario($id_usuario, $texto, $id_bosque)
{
	global $mysqli;

	$id_usuario = filter_var($id_usuario, FILTER_SANITIZE_SPECIAL_CHARS);
	$texto = filter_var($texto, FILTER_SANITIZE_SPECIAL_CHARS);
	$id_bosque = filter_var($id_bosque, FILTER_SANITIZE_SPECIAL_CHARS);
	$sql = "INSERT INTO comentario (id_usuario, texto, id_bosque) VALUES ({$id_usuario}, '{$texto}', {$id_bosque});";
	$mysqli->query($sql);
}

function delete_comentario($id_comentario)
{
	global $mysqli;
	$id_comentario = filter_var($id_comentario, FILTER_SANITIZE_SPECIAL_CHARS);
	$sql = "DELETE FROM comentario WHERE id_comentario = {$id_comentario};";
	$mysqli->query($sql);
}

function like_image($id_imagen, $id_usuario)
{
	global $mysqli;

	$id_imagen = filter_var($id_imagen, FILTER_SANITIZE_SPECIAL_CHARS);
	$id_usuario = filter_var($id_usuario, FILTER_SANITIZE_SPECIAL_CHARS);
	$sql = "INSERT INTO imagen_like(id_imagen, id_usuario) VALUES ({$id_imagen},{$id_usuario});";
	$mysqli->query($sql);
}

function like_forest($id_bosque, $id_usuario)
{
	global $mysqli;

	$id_bosque = filter_var($id_bosque, FILTER_SANITIZE_SPECIAL_CHARS);
	$id_usuario = filter_var($id_usuario, FILTER_SANITIZE_SPECIAL_CHARS);
	$sql = "INSERT INTO bosque_like(id_usuario, id_bosque) VALUES({$id_usuario},{$id_bosque});";
	$mysqli->query($sql);
}

function remove_like_image($id_imagen, $id_usuario)
{
	global $mysqli;

	$id_imagen = filter_var($id_imagen, FILTER_SANITIZE_SPECIAL_CHARS);
	$id_usuario = filter_var($id_usuario, FILTER_SANITIZE_SPECIAL_CHARS);
	$sql = "DELETE FROM imagen_like WHERE id_usuario = {$id_usuario} AND id_imagen = {$id_imagen};";
	$mysqli->query($sql);
}

function remove_like_forest($id_bosque, $id_usuario)
{
	global $mysqli;

	$id_bosque = filter_var($id_bosque, FILTER_SANITIZE_SPECIAL_CHARS);
	$id_usuario = filter_var($id_usuario, FILTER_SANITIZE_SPECIAL_CHARS);
	$sql = "DELETE FROM bosque_like WHERE id_usuario = {$id_usuario} AND id_bosque = {$id_bosque};";
	$mysqli->query($sql);
}

function top10_bosque(){
	global $mysqli;

	$sql = "SELECT * FROM bosque_nlikes ORDER BY nlikes DESC LIMIT 10;";
	$result = $mysqli->query($sql);

	$return = [];
	while ($e = $result->fetch_assoc()) {
		array_push($return, $e);
	}

	return json_encode($return);

}
/*
Especificación del tipo de caracteres para bind de variables
Carácter	Descripción
i	la variable correspondiente es de tipo entero
d	la variable correspondiente es de tipo double
s	la variable correspondiente es de tipo string
b	la variable correspondiente es un blob y se envía en paquetes
*/