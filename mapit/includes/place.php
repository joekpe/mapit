<?php
	class Place{

		public static function for_map($map_id){
			global $database;
			$result = $database->query_db("SELECT * FROM places WHERE deleted = ".NO." AND map_id = '".$map_id."' ");
			return $result;
		}







		
		public static function save($name, $location, $latitude, $longitude, $institution_id, $created_by){
			global $database;
			$result = $database->query_db("INSERT INTO places(name, location, latitude, longitude, institution_id, created_by) VALUES('".$name."', '".$location."', '".$latitude."', '".$longitude."', '".$institution_id."', '".$created_by."')");
			return $result;
		}

		// public static function exists($latitude, $longitude, $institution_id){
		// 	global $database;
		// 	$result = $database->query_db("SELECT * FROM places WHERE latitude = '".$latitude."' AND longitude = '".$longitude."' AND institution_id = '".$institution_id."' ");
		// 	if($database->num_rows($result) > 0){
		// 		return true;
		// 	}
		// 	else{
		// 		return false;
		// 	}
		// }

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