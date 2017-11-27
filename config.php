<?php

	/**
	 * Clase Config (configuración).
	 * Alberga información y configuraciones en forma de constantes y variables,
	 * además de algunas funciones de propósitos variados.
	 */
	final class Config {
		// Desarrollo
		const DEBUG   = true;
		// Variables
		static $title = "Skr PHP";
		// Constantes
		const date_format     = "d/m/y - H:i";
		const db_host         = "localhost";
		const db_name         = "";
		const db_user         = "";
		const db_pass         = "";
		const controller_path = "app/controllers/";
		const helper_path     = "app/helpers/";
		const model_path      = "app/models/";
		const view_path       = "app/view/";
		
		/**
		 * Comprobar si existe una sesión iniciada.
		 * 
		 * @return bool
		 */
		static public function is_user_logged() {
			return (isset($_SESSION['username']))? true : false;
		}
		
		/**
		 * Devolver el usuario que ha iniciado sesión.
		 * 
		 * @return string|bool Nombre de usuario o *falso* si no hay una sesión iniciada.
		 */
		static public function user_logged() {
			return (Config::is_user_logged())? $_SESSION['username'] : false;
		}
		
		/**
		 * Devolver la ID del usuario que ha iniciado sesión.
		 * 
		 * @return int|bool ID del usuario o *falso* si no hay una sesión iniciada.
		 */
		static public function user_logged_id() {
			return (Config::is_user_logged())? $_SESSION['id'] : false;
		}
	}
?>
