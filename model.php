<?php
	/**
	 * Clase Model (modelo).
	 */
	abstract class Model {
		
		/** Conexión con la base de datos. */
		public $connection;
		/** Campo ID. */
		public $id;
		/** Nombre de la tabla. */
		public $table;
		
		/**
		 * Construir un nuevo modelo.
		 */
		public function __construct () {
			$this->connection = new mysqli(Config::db_host, Config::db_user,
				Config::db_pass, Config::db_name);
			$this->connection->set_charset("UTF8");
			$this->table = strtolower(get_class($this));
			$this->id    = strtolower(get_class($this))."id";
		}
		
		/**
		 * Cerrar la conexión al destruir el modelo.
		 */
		public function __destruct () {
			$this->connection->close();
		}
		
		/**
		 * Añadir un registro a la tabla.
		 * 
		 * @param array $new Array asociativo que representa al nuevo registro.
		 * @return bool Si se ha realizado exitosamente la inserción o no.
		 */
		public function add ($new) {
			$first  = true;
			$fields = "";
			$values = "";
			foreach ($new as $key => $value) {
				if (!$first) {
					$fields .= ", ";
					$values .= ", ";
				}
				$fields .= $key;
				$values .= "'" . $value . "'";
				$first   = false;
			}
			$query  = "INSERT INTO $this->table ($fields) VALUES ($values);";
			$result = $this->connection->query($query);
			return $result;
		}
		
		/**
		 * Eliminar el registro con el ID especificado.
		 * 
		 * @param int $id ID del registro.
		 * @return bool Si la consulta se ha llevado acabo exitosamente o no.
		 */
		public function delete ($id) {
			$result = $this->connection->query("DELETE FROM $this->table WHERE $this->id=$id;");
			return $result;
		}
		
		/**
		 * Buscar el registro con el ID especificado.
		 * 
		 * @param int $id ID del registro.
		 * @return Model|bool Objeto encontrado o *false* si no se ha encontrado.
		 */
		public function find ($id) {
			$result = $this->connection->query("SELECT * FROM $this->table WHERE $this->id=$id;");
			return $result->fetch_object(get_class($this));
		}
		
		/**
		 * Actualizar un registro de la tabla.
		 * 
		 * @param int $id ID del registro a actualizar.
		 * @param array $new Array asociativo que representa los cambios del registro.
		 * @return bool Si se ha realizado exitosamente la actualización o no.
		 */
		public function update ($id, $new) {
			$first  = true;
			$values = "";
			foreach ($new as $key => $value) {
				if (!$first) $values .= ", ";
				$values .= "$key='" . $value . "'";
				$first   = false;
			}
			$query  = "UPDATE $this->table SET $values WHERE $this->id=$id;";
			$result = $this->connection->query($query);
			return $result;
		}
		
		/**
		 * Codificar una cadena de caracteres.
		 * 
		 * @param string $string Cadena de caracteres a codificar.
		 * @return string Cadena de caracteres codificada.
		 */
		static public function encode ($string) {
			$tc = new mysqli(Config::db_host, Config::db_name, Config::db_pass);
			$encoded_string = $tc->real_escape_string($string);
			$tc->close();
			return $encoded_string;
		}
		
		/**
		 * Decodificar una cadena de caracteres, pudiendo buscar y sustituir subcadenas.
		 * 
		 * @param string $string Cadena de caracteres codificada.
		 * @param array $search Conjunto de cadenas de caracteres a buscar.
		 * @param array $replace Conjunto de cadena de caracteres a reemplazar.
		 * @return string Cadena de caracteres decodificada.
		 */
		static public function decode ($string, $search = [], $replace = []) {
			return stripcslashes(htmlspecialchars($string));
		}
	}
?>
