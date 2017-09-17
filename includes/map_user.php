<?php
	class MapUser{

		public static function assign_to_maps($map_ids, $user_id, $institution_id){
			global $database;
			foreach ($map_ids as $map_id) {
				$result = $database->query_db("INSERT INTO map_users(map_id, user_id, institution_id) VALUES('".$map_id."', '".$user_id."', '".$institution_id."')");
			}

			if($result){
				return true;
			}
			else{
				return false;
			}
		}

		public static function get_user_maps($user_id, $institution_id){
			global $database;
			$resut = $database->query_db("SELECT maps.map_id, maps.name FROM map_users LEFT JOIN maps ON map_users.map_id = maps.map_id WHERE map_users.user_id = '".$user_id."' AND map_users.institution_id = '".$institution_id."' AND maps.deleted = ".NO." ");
			return $resut;
		}

	}
?>