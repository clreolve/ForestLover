<?php
session_start();

function debug($var) {
	echo "<pre>";
	var_dump($var);
	echo "</pre>";
}