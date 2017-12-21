<?php
	class Application {
		/** Controller (and its default) */
		public $controller = "MainController";
		/** Method (and its default) */
		public $method = "index";
		/** URL parameters */
		public $params = [];
		
		/**
		 * Automatically configure and execute your application.
		 */
		public function __construct () {
			// Parse URL
			$url = $this->parse_url();
			// Load Controller
			if (isset($url[0])) {
				$controller_class = ucfirst(strtolower($url[0])) . "Controller";
				$controller_file = Config::controller_path . $controller_class . ".php";
				if (file_exists($controller_file)) {
					$this->controller = $controller_class;
					unset($url[0]);
				}
			}
			require_once Config::controller_path . $this->controller . ".php";
			$this->controller = new $this->controller();
			// Find the method
			if (isset($url[1])) {
				$method_name = strtolower($url[1]);
				if (method_exists($this->controller, $method_name)) {
					$this->method = $method_name;
					unset($url[1]);
				}
			}
			// Parse parameters
			$this->params = ($url != null)? array_values($url) : [];
			// Execute
			if (method_exists($this->controller, $this->method)) {
				call_user_func_array([$this->controller, $this->method],
					$this->params);
			} else {
				force_redirect();
			}
			View::show();
		}
		
		/**
		 * Parse the URL.
		 */
		private function parse_url () {
			if (isset($_GET['url'])) {
				return explode("/", filter_var(rtrim($_GET['url'], "/"), FILTER_SANITIZE_URL));
			}
		}
	}
?>
