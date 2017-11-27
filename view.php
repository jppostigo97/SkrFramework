<?php

/**
 * Clase View (vista).
 * Se encarga de mostrar correctamente la página requerida y de pasarle los parámetros que tenemos.
 */
final class View {
	
	static public function render($view, $params = []) {
		foreach($params as $key => $value) {
			$$key = $value;
		}
		require_once Config::view_path . $view . ".php";
	}
}

?>
