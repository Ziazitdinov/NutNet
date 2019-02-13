<?php

	$host = 'localhost';
	$user = 'root';
	$password = '';
	$name = 'php';

	$mysqli = new mysqli($host, $user, $password, $name);
	$mysqli->query("SET NAMES 'utf-8'");

	if ($mysqli->connect_errno) {
		echo "Не удалось...".$mysqli->connect_error;
	}
?>