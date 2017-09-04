<?php
	class User{
		var $name;
		var $email;
		var $password;
		var $access_level;
		

		function __construct()
		{
			
		}

		public static function register($institution_id, $user_id, $user_full_name, $user_email, $user_password, $user_phone, $institution_name, $hash){
			global $database;
			$user_reg = $database->query_db("INSERT INTO users(user_id, full_name, email, password, phone, hash) VALUES('".$user_id."', '".$user_full_name."', '".$user_email."', '".sha1($user_password)."', '".$user_phone."', '".$hash."')");

			$institution_reg = Institution::new_institution($institution_id, $institution_name);

			$user_institution_reg = UserInstitution::save($user_id, $institution_id, POWER);

			if($user_reg and $institution_reg and $user_institution_reg){
				$to = $user_email;
				$subject = 'Locator App Signup | Verification'; // Give the email a subject 
				$message = '
				 
				Thanks for signing up!
				Activate your account by pressing or clicking the link below.
				 
				------------------------
				Full Name: '.$user_full_name.'
				Institution Name: '.$institution_name.'
				Phone: '.$user_phone.'
				------------------------
				 
				Please click this link to activate your account:
				 http://'.$_SERVER['HTTP_HOST'].'/verify.php?email='.$user_email.'&hash='.$hash.'
				 
				'; // Our message above including the link

				$headers = APP_EMAIL . "\r\n" .
						    'Reply-To: '.APP_EMAIL . "\r\n" .
						    'X-Mailer: PHP/' . phpversion();
				            

				mail($to, $subject, $message, $headers);

				return true;

			}
			else{
				return false;
			}
		}

		public static function is_user($email){
			global $database;
			$result = $database->query_db("SELECT * FROM users WHERE email='".$email."' AND deleted = ".NO." ");
			$answer = $database->num_rows($result);
			if($answer > 0){
				return true;
			}
			else{
				return false;
			}
		}


		public static function create_admin($institution_id, $user_id, $user_full_name, $user_email, $user_password, $user_phone){
			global $database;
			$user_reg = $database->query_db("INSERT INTO users(user_id, full_name, email, password, phone, active) VALUES('".$user_id."', '".$user_full_name."', '".$user_email."', '".sha1($user_password)."', '".$user_phone."', '".YES."')");
			
			$user_institution_reg = UserInstitution::save($user_id, $institution_id, ADMIN);

			if($user_reg  and $user_institution_reg){
				$to = $user_email;
				$subject = 'Locator App Registration | Verification'; // Give the email a subject 
				$message = '
				 
				Below are you details to log in
				 
				------------------------
				Full Name: '.$user_full_name.'
				Phone: '.$user_phone.'
				Password: '.$user_password.'
				------------------------
				 
				
				 
				'; // Our message above including the link

				$headers = 'From: webmaster@example.com' . "\r\n" .
						    'Reply-To: '.APP_EMAIL . "\r\n" .
						    'X-Mailer: PHP/' . phpversion();
				            

				mail($to, $subject, $message, $headers);

				return true;

			}
			else{
				return false;
			}
		}

		public static function create_client($institution_id, $user_id, $full_name, $email, $password, $phone){
			global $database;
			$user_reg = $database->query_db("INSERT INTO users(user_id, full_name, email, password, phone, active) VALUES('".$user_id."', '".$full_name."', '".$email."', '".sha1($password)."', '".$phone."', ".YES." )");

			$user_institution_reg = UserInstitution::save($user_id, $institution_id, CLIENT);

			if($user_reg and $user_institution_reg){
				return true;
			}
			else{
				return false;
			}
		}

		public static function find_by_email($email){
			global $database;
			$results = $database->query_db("SELECT * FROM users WHERE email='".$email."' AND deleted = ".NO." ");
			return $results;
		}











		public static function total_users(){
			global $database;
			$result = $database->query_db("SELECT * FROM users WHERE deleted = ".NO." ");
			$number = $database->num_rows($result);
			return $number;
		}

		public static function count_power(){
			global $database;
			$result = $database->query_db("SELECT * FROM users WHERE access_level = ".POWER." AND deleted = ".NO." ");
			$number = $database->num_rows($result);
			return $number;
		}

		public static function count_admin(){
			global $database;
			$result = $database->query_db("SELECT * FROM users WHERE access_level = ".ADMIN." AND deleted = ".NO." ");
			$number = $database->num_rows($result);
			return $number;
		}


		public static function count_client(){
			global $database;
			$result = $database->query_db("SELECT * FROM users WHERE access_level = ".CLIENT." AND deleted = ".NO." ");
			$number = $database->num_rows($result);
			return $number;
		}

		public static function count_institution_clients($institution_id){
			global $database;
			$result = $database->query_db("SELECT * FROM users WHERE access_level = ".CLIENT." AND deleted = ".NO." AND institution_id = '".$institution_id."' ");
			$number = $database->num_rows($result);
			return $number;
		}

		public static function count_institution_admins($institution_id){
			global $database;
			$result = $database->query_db("SELECT * FROM users WHERE access_level = ".ADMIN." AND deleted = ".NO." AND institution_id = '".$institution_id."' ");
			$number = $database->num_rows($result);
			return $number;
		}



		// public static function create_admin($full_name, $email, $password, $primary_phone, $secondary_phone, $institution_id, $created_by){
		// 	global $database;
		// 	$result = $database->query_db("INSERT INTO users(full_name, email, password, primary_phone, secondary_phone, institution_id, access_level, created_by) VALUES('".$full_name."', '".$email."', '".sha1($password)."', '".$primary_phone."', '".$secondary_phone."', '".$institution_id."', '".ADMIN."', '".$created_by."')");
		// 	return $result;
		// }

		

		public static function update_client($id, $full_name, $email, $primary_phone, $secondary_phone, $modified_by){
			global $database;
			$result = $database->query_db("UPDATE users SET full_name = '".$full_name."', email = '".$email."', primary_phone = '".$primary_phone."', secondary_phone = '".$secondary_phone."', created_by = '".$modified_by."' WHERE user_id = '".$id."'");
			return $result;
		}

		public static function delete_user($id){
			global $database;
			$results = $database->query_db("UPDATE users SET deleted = ".YES." WHERE user_id='".$id."'");
			return $results;
		}

		public static function restore_user($id){
			global $database;
			$results = $database->query_db("UPDATE users SET deleted = ".NO." WHERE user_id='".$id."'");
			return $results;
		}

		public static function find_by_id($id){
			global $database;
			$results = $database->query_db("SELECT * FROM users WHERE user_id='".$id."'");
			return $results;
		}

		public static function find_institution_clients($institution_id){
			global $database;
			$results = $database->query_db("SELECT * FROM users WHERE institution_id='".$institution_id."' AND deleted = ".NO." AND access_level = ".CLIENT." ");
			return $results;
		}

		public static function find_deleted_institution_clients($institution_id){
			global $database;
			$results = $database->query_db("SELECT * FROM users WHERE institution_id='".$institution_id."' AND deleted = ".YES." AND access_level = ".CLIENT." ");
			return $results;
		}

		public static function find_deleted_admins(){
			global $database;
			$results = $database->query_db("SELECT * FROM users WHERE  deleted = ".YES." AND access_level = ".ADMIN." ");
			return $results;
		}

		public static function find_all(){
			global $database;
			$results = $database->query_db("SELECT * FROM users WHERE deleted='no'");
			return $results;
		}

		

		


		public static function get_name($id){
			global $database;
			$n = $database->query_db("SELECT full_name FROM users WHERE user_id = '".$id."' ");
			$result = $database->fetch_array($n);
			$name = $result['full_name'];
			return $name;
		}

		public static function is_power($access_level){
			global $database;
			if($access_level === POWER){
				return true;
			}
			else{
				return false;
			}
		}

		public static function is_admin($access_level){
			global $database;
			if($access_level === ADMIN){
				return true;
			}
			else{
				return false;
			}
		}


		public static function is_client($access_level){
			global $database;
			if($access_level === CLIENT){
				return true;
			}
			else{
				return false;
			}
		}






	}

	
?>