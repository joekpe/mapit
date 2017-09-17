<?php
	class Map{

		public static function new_map($map_id, $name, $map_doc_id, $institution_id, $created_by){
			global $database;
			$result = $database->query_db("INSERT INTO maps(map_id, name, map_doc_id, institution_id, created_by)VALUES('".$map_id."', '".$name."', '".$map_doc_id."', '".$institution_id."', '".$created_by."')");

			if($result){
				createMap($map_id);
				return true;
			}
			else{
				return false;
			}
		}


		public static function find_by_id($map_id){
			global $database;
			$result = $database->query_db("SELECT * FROM maps WHERE map_id = '".$map_id."' AND deleted = ".NO." ");
			return $result;
		}

	}
?>