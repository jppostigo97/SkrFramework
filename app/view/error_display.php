<?php
	setcookie($GLOBALS['error_code'], "", time() - 1);
	if(isset($_COOKIE[$GLOBALS['error_code']])) {
		$error = unserialize($_COOKIE[$GLOBALS['error_code']]);
		echo "<section id=\"error-display\" class=\"dialog\">";
		echo "<h3>" . $error['title'] . "</h3>";
		echo "<div>" . $error['content'] . "</div>";
		echo "</section>";
	}
?>
