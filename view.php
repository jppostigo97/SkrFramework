<?php
	/**
	 * Clase View (vista).
	 * Se encarga de mostrar correctamente la página requerida y de pasarle los parámetros que tenemos.
	 */
	final class View {
		
		/**
		 * Mostrar una vista contenida dentro de la carpeta de vistas, además
		 * de abrir y cerrar la plantilla.
		 * 
		 * @param string $view Nombre del archivo de la vista (sin extensión).
		 * @param array $params Array asociativo nombre-valor de los parámetros.
		 */
		static public function full_render ($view, $params = []) {
			self::render("layout/open");
			self::render($view, $params);
			self::render("layout/close");
		}
		
		/**
		 * Mostrar una vista contenida dentro de la carpeta de vistas.
		 * 
		 * @param string $view Nombre del archivo de la vista (sin extensión).
		 * @param array $params Array asociativo nombre-valor de los parámetros.
		 */
		static public function render ($view, $params = []) {
			foreach ($params as $key => $value)
				$$key = $value;
			require_once Config::view_path . $view . ".php";
		}
	}
?>
