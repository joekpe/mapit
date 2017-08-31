<?php
	class UserInstitution{
		public static function exists($user_id, $institution_id){
			global $database;
			$result = $database->query_db("SELECT * FROM user_institutions WHERE user_id='".$user_id."'  AND institution_id = '".$institution_id."'");
			$answer = $database->num_rows($result);
			if($answer > 0){
				return true;
			}
			else{
				return false;
			}
		}
	}

?>