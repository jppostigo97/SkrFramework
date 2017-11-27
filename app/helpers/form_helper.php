<?php
	/**
	 * Clase FormHelper (para la creación de formularios).
	 */
	class FormHelper {
			
		/**
		 * Crear un nuevo formulario.
		 * 
		 * @param string $action Archivo que procesará el formulario.
		 * @param string $method Método HTTP mediante el cual se enviarán los datos.
		 * @param array $params Array asociativo atributo-valor para el formulario.
		 * @param string $title Título del formulario.
		 */
		public function open($action = ".", $method = "POST", $params = [], $title = "") {
			if(isset($params)) {
				echo "<form action=\"$action\" method=\"$method\"";
				foreach($params as $attribute => $value) {
					echo " $attribute=\"$value\"";
				}
				echo ">";
			} else {
				echo "<form action=\"$action\" method=\"$method\">";
			}
			if($title != "") echo "<h3>$title</h3>";
			echo "<div class=\"form-content\">";
		}
		
		/**
		 * Añadir un nuevo campo junto con su etiqueta al formulario.
		 * 
		 * @param string $type Tipo de campo.
		 * @param string $name Nombre del campo.
		 * @param string $label_display Texto que se mostrará en la etiqueta del campo.
		 * @param bool $required Si el campo es obligatorio o no.
		 * @param array $params Array asociativo atributo-valor para el campo del formulario.
		 */
		public function add_input($type, $name, $label_display = "", $required = false, $params = []) {
			echo "<div class=\"form-field\">";
			if($label_display != "") echo "<label for=\"$name\">$label_display: </label>";
			echo "<input type=\"$type\" name=\"$name\" ";
			foreach($params as $attribute => $value) {
				echo "$attribute=\"$value\" ";
			}
			if($required) echo "required";
			echo "/></div>";
		}
		
		/**
		 * Añadir un área de texto.
		 * 
		 * @param string $name Nombre del área de texto.
		 * @param string $label Texto que muestra la etiqueta del área.
		 * @param bool $required Si el área es obligatoria o no.
		 * @param string $ta_value Contenido por defecto del área.
		 * @param array $params Array asocitativo atributo-valor para el área.
		 */
		public function add_textarea($name, $label = "", $required = false, $ta_value = "",
			$params = []) {
			echo "<div class=\"form-field\">";
			if($label != "") echo "<label for=\"$name\">$label:</label>";
			echo "<textarea name=\"$name\"";
			foreach($params as $attribute => $value) {
				echo " $attribute=\"$value\"";
			}
			echo ">";
			if($ta_value != "")
				echo $ta_value;
			echo "</textarea></div>";
		}
		
		/**
		 * Añadir un checkbox.
		 * 
		 * @param string $name Nombre del checkbox.
		 * @param string $label Texto del checkbox.
		 * @param bool $required Si es requerido marcar la casilla.
		 */
		public function add_checkbox($name, $label, $required = false, $checked = false) {
			echo "<input type=\"checkbox\" name=\"$name\" ";
			if($required) echo "required ";
			if($checked) echo "checked ";
			echo "/>";
			echo "<label for=\"$name\">$label</label>";
		}
		
		/**
		 * Añadir un campo de selección.
		 * 
		 * @param string $name Nombre del campo de selección.
		 * @param array $options Array asociativo texto-valor de las opciones del campo.
		 * @param string $label Etiqueta del campo.
		 * @param array $params Array asociativo atributo-valor del campo.
		 */
		public function add_selection($name, $options, $label = "", $params = []) {
			echo "<div class=\"form-field\">";
			if($label != "") echo "<label for=\"$name\">$label</label>";
			echo "<select name=\"$name\" ";
			foreach($params as $attribute => $value) {
				echo "$attribute=\"$value\" ";
			}
			echo ">";
			foreach($options as $text => $value) {
				echo "<option value=\"$value\">$text</option>";
			}
			echo "</select></div>";
		}
		
		/**
		 * Añadir un campo del tipo "hidden" al formulario.
		 * 
		 * @param string $name Nombre del campo.
		 * @param string $value Valor del campo.
		 */
		public function add_hidden_value($name, $value) {
			echo "<input type=\"hidden\" name=\"$name\" value=\"$value\" />";
		}

		/**
		 * Añadir un botón de envío al formulario.
		 * 
		 * @param string $text Texto a mostrar en el botón.
		 * @param array $params Parámetros adicionales.
		 */
		function add_submit_button($text, $params = []) {
			if($params == []) {
				echo "</div><button type=\"submit\">$text</button>";
			} else {
				echo "</div><button type=\"submit\"";
				foreach($params as $attribute => $value)
					echo " $attribute=\"$value\"";
				echo ">$text</button>";
			}
		}
		
		/**
		 * Cerrar el formulario.
		 */
		public function close() {
			echo "</form>";
		}
	}
?>
