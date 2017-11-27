<?php

	/*
	
	Model de ejemplo.
	Crear un modelo es sencillo y se hace en tan solo 3 pasos:
	1. Crear el archivo de modelo en la carpeta correspondiente (app/models/ por defecto).
	2. Dentro, crear una clase nombrada en UpperCamelCase que extienda a Model.
	3. Añadir todas las propiedades que equivalgan a campos en la base de datos y métodos a utilizar.
	
	*/

	class User extends Model {

		public $userid;
		public $username;
		public $email;
		public $password;
		public $description;
		public $date_time;
		public $level;
		public $verified;
		public $user_key;
		
		/**
		 * Buscar un usuario con un email concreto.
		 * 
		 * @param string $email Email del usuario.
		 * @param mysqli_result|bool Resultado de la consulta o *false* si no se ha encontrado.
		 */
		public function find_by_email($email) {
			$result = $this->connection->query(
				"SELECT * FROM $this->table WHERE email='$email'");
			return $result->fetch_object(get_class($this));
		}
		
		/**
		 * Buscar un usuario con un nombre concreto.
		 * 
		 * @param string $username Nombre del usuario.
		 * @param mysqli_result|bool Resultado de la consulta o *false* si no se ha encontrado.
		 */
		public function find_by_username($username) {
			$result = $this->connection->query(
				"SELECT * FROM $this->table WHERE username='$username'");
			return $result->fetch_object(get_class($this));
		}
	}
?>
