<?php
	/**
	 * Incluir el cierre de la estructura.
	 */
	function close () {
		require_once Config::view_path . "base_close.php";
	}
	
	/**
	 * Mostrar un error en caso de que exista.
	 * 
	 * @param string $identifier Identificador del mensaje de error.
	 */
	function display_error ($identifier) {
		if (isset($_COOKIE[$identifier])) {
			$error = unserialize($_COOKIE[$identifier]);
			echo "<div class\"dialog\" id=\"error-display\">";
			echo "<h3>" . $error['title'] . "</h3>";
			echo "<div>" . $error['content'] . "</div>";
			echo "</div>";
			setcookie($identifier, "", time() - 1);
		}
	}
	
	/**
	 * Crear un mensaje de error.
	 * 
	 * @param string $identifier Identificador del mensaje de error.
	 * @param string $title Título del mensaje.
	 * @param string $content Contenido del mensaje.
	 */
	function error ($identifier, $title, $content) {
		setcookie($identifier, serialize([
			"title" => $title, "content" => $content]),
			time() + 300);
	}
	
	/**
	 * Enlazar una hoja de estilos.
	 * 
	 * @param string $css Nombre de la hoja de estilos (sin .css).
	 * @param array $params Atributos opcionales.
	 */
	function link_css ($css, $params = []) {
		echo "<link rel=\"stylesheet\" href=\"" . APP_PATH . "app/assets/css/" . $css . ".css\"";
		if (!empty($params)) {
			foreach ($params as $attr => $value)
				echo " $attr=\"$value\"";
		}
		echo " />";
	}
	
	/**
	 * Enlazar un archivo javascript.
	 * 
	 * @param string $script Nombre del script (sin el .js).
	 * @param array $params Atributos opcionales.
	 */
	function link_script ($script, $params =[]) {
		echo "<script src=\"" . APP_PATH . "app/assets/js/" . $script . ".js\"";
		if (!empty($params)) {
			foreach ($params as $attr => $value)
				echo " $attr=\"$value\"";
		}
		echo "></script>";
	}
	
	/**
	 * Crear un hipervínculo.
	 * 
	 * @param string $link Dirección del enlace.
	 * @param string $label Texto a mostrar en el enlace.
	 * @param array $params Atributos opcionales.
	 */
	function link_to ($link, $label, $params = []) {
		echo "<a href=\"" . APP_PATH . $link . "\"";
		foreach ($params as $attr => $value)
			echo " $attr=\"$value\"";
		echo ">$label</a>";
	}
	
	/**
	 * Incluir el fichero que contiene un modelo, cargarlo y devolverlo.
	 * 
	 * @param string $model_name Nombre del modelo.
	 * @return Model
	 */
	function load_model ($model_name) {
		$model_class = ucfirst($model_name);
		$model_file  = Config::model_path . strtolower($model_name) . ".php";
		if (file_exists($model_file)) {
			require_once $model_file;
			return new $model_class();
		} else {
			if (Config::DEBUG) die("No se ha encontrado el archivo del modelo $model_class.");
			else die("");
		}
	}

	/**
	 * Incluir el fichero que contiene un asistente, cargarlo y devolverlo.
	 * 
	 * @param string $helper_name Nombre del asistente.
	 * @return Helper
	 */
	function load_helper ($helper_name) {
		$helper_class = ucfirst($helper_name) . "Helper";
		$helper_file  = Config::helper_path . strtolower($helper_name) . "_helper.php";
		if (file_exists($helper_file)) {
			require_once $helper_file;
			return new $helper_class();
		} else {
			if (Config::DEBUG) die("No se ha encontrado el archivo del helper $helper_class.");
			else die("");
		}
	}
	
	/**
	 * Prohibir al usuario acceder si ha iniciado sesión.
	 */
	function forbid_login () {
		if (Config::is_user_logged())
			force_redirect();
	}
	
	/**
	 * Incluir la apertura de la estructura.
	 */
	function open () {
		require_once Config::view_path . "base_open.php";
	}

	/**
	 * Parsear la fecha y la hora en base a un string.
	 * 
	 * @param string $format Formato.
	 * @param string $date_time Fecha y hora a parsear.
	 */
	function parse_datetime ($format, $date_time) {
		return DateTime::createFromFormat("Y-m-d H:i:s", $date_time)->format($format);
	}

	/**
	 * Forzar la redirección.
	 */
	function force_redirect ($url) {
		header("Location: " . APP_PATH . $url);
		exit();
	}
	
	/**
	 * Requerir que exista una sesión iniciada por parte del usuario.
	 * En caso de que la sesión no esté iniciada, devuelve al usuario a la página principal.
	 */
	function require_login () {
		if (!Config::is_user_logged())
			force_redirect();
	}
	
	/**
	 * Devolver o modificar el título de la página.
	 * El título se modificará solo si se envía un string como parámetro.
	 * 
	 * @param string $title Nuevo título.
	 * @return string Título actual.
	 */
	function title ($title = "") {
		if ($title != "") Config::$title = $title;
		else return Config::$title;
	}
?>
