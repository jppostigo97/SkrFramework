<?php
	// Habilitar el uso de sesiones
	session_start();

	// Edita el APP_PATH para que todos los enlaces funcionen correctamente
	// IMPORTANTE que APP_PATH termine en /
	define("APP_PATH", "http://localhost/skr/");
	
	// Insertar archivos básicos del framework
	require_once "application.php";
	require_once "config.php";
	require_once "controller.php";
	require_once "functions.php";
	require_once "model.php";
	require_once "view.php";
	
	$app = new Application();
?>
