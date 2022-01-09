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

function add( $email, $password )
{
	global $mysqli;
	$sql = "INSERT INTO user(id, email, password) VALUES (null, '{$email}', '{$password}')";
	$mysqli->query($sql);

}

function update( $id, $email, $password )
{
	global $mysqli;
	$sql = "UPDATE user SET email = '{$email}', password = '{$password}' WHERE id = {$id}";
	$mysqli->query($sql);
}

function delete( $id )
{
	global $mysqli;
	$sql = "DELETE FROM user WHERE id = {$id}";
	$mysqli->query($sql);
}

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