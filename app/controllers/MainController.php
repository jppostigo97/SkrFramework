<?php
	class MainController extends Controller {
		
		public function index() {
			open();
			View::render("main/test", ["param" => "value", "param2" => "value2"]);
			close();
		}
	}
?>
