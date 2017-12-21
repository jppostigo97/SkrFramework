<?php

	/*
	
	Example model.
	How to create a model in just 3 steps.
	1. Create the model file in its correspondent directory. (default is ~/app/models).
	2. Create inside your new file a class named with UpperCamelCase that extends from Model.
	3. Add all the properties with the same name as in your database
		and all the methods that you want to use.
	
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
		 * Find an user whose email is...
		 * 
		 * @param string $email User's email.
		 * @param mysqli_result|bool Query result or *false* if no user found.
		 */
		public function find_by_email($email) {
			$result = $this->connection->query(
				"SELECT * FROM $this->table WHERE email='$email'");
			return $result->fetch_object(get_class($this));
		}
		
		/**
		 * Find an user whose username is..
		 * 
		 * @param string $username User's username.
		 * @param mysqli_result|bool Query result or *false* if no user found.
		 */
		public function find_by_username($username) {
			$result = $this->connection->query(
				"SELECT * FROM $this->table WHERE username='$username'");
			return $result->fetch_object(get_class($this));
		}
	}
?>
