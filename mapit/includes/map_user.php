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

	}
?>