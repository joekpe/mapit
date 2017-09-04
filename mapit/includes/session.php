<?php
	class Session{

		function __construct()
		{

		}

		public static function logout(){
			$result = session_destroy();
			return $result;
		}

		public static function is_authenticated(){
			if(isset($_SESSION['locator_user_id'])){
				return true;
			}
			return false;
		}

		public static function message($message = 1, $level){
			$_SESSION['message'] = $message;
			$_SESSION['message_level'] = $level;
			$_SESSION['expire_message'] = time() + 0.1;
		}

		public static function clear_message(){
			if(time() > $_SESSION['expire_message']){
				unset($_SESSION['message']);
				unset($_SESSION['message_level']);
			}
		}

		public static function message_exists(){
			if(@isset($_SESSION['message'])){
				return true;
			}
			else{
				return false;
			}
		}

	}
?>