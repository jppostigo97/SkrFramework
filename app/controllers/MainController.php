<?php
	class MainController extends Controller {
		
		public function index () {
			View::template("main");
			View::load("main/test", ["param" => "value", "param2" => "value2"]);
		}
	}
?>
