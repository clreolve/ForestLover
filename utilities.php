<?php
session_start();

function debug($var) {
	echo "<pre>";
	var_dump($var);
	echo "</pre>";
}

function islogin(){
	if(isset($_SESSION["uid"])){
		return true;
	}else{
		return false;
	}
}

function get_uid(){
	return isset($_SESSION["uid"]) ? $_SESSION["uid"] : "";
}