<?php
require_once('database_credentials.php');
$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
$result = '';

if( $mysqli->connect_errno )
{
	echo 'Error en la conexión';
	exit;
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
	$sql = "SELECT * FROM user_access WHERE email = '{$email}'";
	$result = $mysqli->query($sql);
	return $result->fetch_assoc();
}


function add_user( $email, $password )
{
	global $mysqli;
	$email_sanitized = filter_var($email, FILTER_SANITIZE_SPECIAL_CHARS);
	$password_sanitized = filter_var($password, FILTER_SANITIZE_SPECIAL_CHARS);

	$sql = "INSERT INTO user(id, email, password) VALUES (null, '{$email_sanitized}', '{$password_sanitized}')";
	$mysqli->query($sql);

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