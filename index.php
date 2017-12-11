<?php
	// Habilitar el uso de sesiones
	session_start();

	// Edita el APP_PATH para que todos los enlaces funcionen correctamente
	// IMPORTANTE que APP_PATH termine en /
	// Sustituir "/SkrFramework" por la ruta de tu aplicación dentro del servidor o dejar vacía.
	define("APP_PATH", "http://" . $_SERVER['SERVER_NAME']. "/SkrFramework/");
	
	// Insertar archivos básicos del framework
	require_once "application.php";
	require_once "config.php";
	require_once "controller.php";
	require_once "functions.php";
	require_once "model.php";
	require_once "view.php";
	
	$app = new Application();
?>
