<?php
	class MapDoc{

		public static function new_map_doc($map_doc_id, $name, $institution_id, $created_by){
			global $database;
			$result = $database->query_db("INSERT INTO map_docs(map_doc_id, name, institution_id, created_by)VALUES('".$map_doc_id."', '".$name."', '".$institution_id."', '".$created_by."')");
			if($result){
				return true;
			}
			else{
				return false;
			}
		}

	}
?>