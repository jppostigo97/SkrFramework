<?php
	/**
	 * Show an error message if it does exists.
	 * 
	 * @param string $identifier Error message identifier.
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
	 * Create an error message.
	 * 
	 * @param string $identifier Error message identifier.
	 * @param string $title Message title.
	 * @param string $content Message content.
	 */
	function error ($identifier, $title, $content) {
		setcookie($identifier, serialize([
			"title" => $title, "content" => $content]),
			time() + 300);
	}
	
	/**
	 * Link a local stylesheet.
	 * 
	 * @param string $css Stylesheet filename (without extension).
	 * @param array $params Optional attributes for the <link> tag.
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
	 * Link a local javascript file.
	 * 
	 * @param string $script Script filename (without extension).
	 * @param array $params Optional attributes for the <script> tag.
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
	 * Create an hyperlink.
	 * 
	 * @param string $link Link URL.
	 * @param string $label Link label.
	 * @param array $params Optional attributes for the <a> tag.
	 */
	function link_to ($link, $label, $params = []) {
		echo "<a href=\"" . APP_PATH . $link . "\"";
		foreach ($params as $attr => $value)
			echo " $attr=\"$value\"";
		echo ">$label</a>";
	}
	
	/**
	 * Load, create an instance and return a model.
	 * 
	 * @param string $model_name Model name.
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
	 * Load, create an instance and return a helper.
	 * 
	 * @param string $helper_name Helper name.
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
	 * Make the user unable to access if he/she is logged in.
	 */
	function forbid_login () {
		if (Config::is_user_logged())
			force_redirect();
	}
	
	/**
	 * Parse datetime.
	 * 
	 * @param string $format Date/time format.
	 * @param string $date_time Date and time to parse.
	 */
	function parse_datetime ($format, $date_time) {
		return DateTime::createFromFormat("Y-m-d H:i:s", $date_time)->format($format);
	}

	/**
	 * Force a redirection.
	 * 
	 * @param string $url New location.
	 */
	function force_redirect ($url) {
		header("Location: " . APP_PATH . $url);
		exit();
	}
	
	/**
	 * Make the user unable to access if he/she isn't logged in.
	 */
	function require_login () {
		if (!Config::is_user_logged())
			force_redirect();
	}
	
	/**
	 * Returns or modify page title.
	 * 
	 * @param string $title New title.
	 * @return string Page title.
	 */
	function title ($title = "") {
		if ($title != "") Config::$title = $title;
		else return Config::$title;
	}
?>
