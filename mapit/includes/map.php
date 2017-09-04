<?php
	class Map{

		public static function new_map($map_id, $name, $map_doc_id, $institution_id, $created_by){
			global $database;
			$result = $database->query_db("INSERT INTO maps(map_id, name, map_doc_id, institution_id, created_by)VALUES('".$map_id."', '".$name."', '".$map_doc_id."', '".$institution_id."', '".$created_by."')");

			if($result){
				createMap($name, $map_id);
				return true;
			}
			else{
				return false;
			}
		}

	}
?>