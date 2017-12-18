<?php
	class MainController extends Controller {
		
		public function index () {
			View::render("layout/open");
			View::render("main/test", ["param" => "value", "param2" => "value2"]);
			View::render("layout/close");
			/*
				Otra forma de hacer lo mismo de una forma más corta:
				el método estático full_render() de la clase View acepta los mismos parámetros
				que el método render, pero además utiliza la plantilla de forma automática.
				
				View::full_render("main/test", ["param" => "value", "param2" => "value2"]);
			*/
		}
	}
?>
