<?php
	class PlaceType{
		public static function save($map_id, $place_types){
			global $database;
			foreach ($place_types as $place_type) {
				$result = $database->query_db("INSERT INTO place_types(map_id, place_type) VALUES('".$map_id."', '".$place_type."')");
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