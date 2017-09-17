<?php
	class Place{

		public static function for_map($map_id){
			global $database;
			$result = $database->query_db("SELECT * FROM places WHERE deleted = ".NO." AND map_id = '".$map_id."' ");
			return $result;
		}


		public static function save($name, $description, $address, $latitude, $longitude, $place_type, $map_id, $institution_id, $created_by){
			global $database;
			$result = $database->query_db("INSERT INTO places(name, description, address, latitude, longitude, place_type,  map_id, institution_id, created_by) VALUES('".$name."', '".$description."', '".$address."', '".$latitude."', '".$longitude."', '".$place_type."', '".$map_id."', '".$institution_id."', '".$created_by."')");
			if($result){
				return true;
			}
			else{
				return false;
			}
		}

		public static function exists($latitude, $longitude, $institution_id, $place_type){
			global $database;
			$result = $database->query_db("SELECT * FROM places WHERE latitude = '".$latitude."' AND longitude = '".$longitude."' AND institution_id = '".$institution_id."' AND place_type = '".$place_type."' ");
			if($database->num_rows($result) > 0){
				return true;
			}
			else{
				return false;
			}
		}


		public static function get_places_for_map($institution_id, $map_id){
			global $database;
			$result = $database->query_db("SELECT place_types.place_type as place_type_name, places.place_id, places.name, places.address, places.description, places.latitude, places.longitude, places.map_id FROM place_types LEFT JOIN places ON place_types.place_type_id = places.place_type WHERE places.map_id = '".$map_id."' AND places.institution_id = '".$institution_id."' ");
			return $result;
		}

		public static function get_places_for_my_map($user_id, $institution_id, $map_id){
			global $database;
			$result = $database->query_db("SELECT place_types.place_type as place_type_name, places.place_id, places.name, places.address, places.description, places.latitude, places.longitude, places.map_id FROM place_types LEFT JOIN places ON place_types.place_type_id = places.place_type WHERE places.map_id = '".$map_id."' AND places.institution_id = '".$institution_id."' AND created_by = '".$user_id."' ");
			return $result;
		}

		// public static function count_places(){
		// 	global $database;
		// 	$result = $database->query_db("SELECT * FROM places WHERE deleted = '".NO."' ");
		// 	$num = $database->num_rows($result);
		// 	return $num;
		// }

		// public static function count_instititution_places($institution_id){
		// 	global $database;
		// 	$result = $database->query_db("SELECT * FROM places WHERE deleted = '".NO."' AND institution_id = '".$institution_id."' ");
		// 	$num = $database->num_rows($result);
		// 	return $num;
		// }

		// public static function count_client_places_marked($institution_id, $client_id){
		// 	global $database;
		// 	$result = $database->query_db("SELECT * FROM places WHERE deleted = ".NO." AND institution_id = '".$institution_id."' AND created_by = '".$client_id."' ");
		// 	$number = $database->num_rows($result);
		// 	return $number;
		// }

		// public static function all(){
		// 	global $database;
		// 	$result = $database->query_db("SELECT * FROM places WHERE deleted = ".NO." ");
		// 	return $result;
		// }

		
	}
?>