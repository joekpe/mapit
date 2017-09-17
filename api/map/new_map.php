<?php
header("Content-Type:application/json");
include_once("../../includes/includes.php");
if( isset($_GET['name']) ) {
	$map_id = 'MAP-'.uniqid();
	$map_doc_id = $database->prep($_GET['map_doc_id']);
	$name = $database->prep($_GET['name']);
	$created_by = $database->prep($_GET['user_id']);
	$institution_id = $database->prep($_GET['institution_id']);
	$place_types = json_decode(@$_GET['place_types']);

	if( empty($map_doc_id) or empty($name) or empty($created_by) or empty($institution_id) ){
	  jsonResponse(400,"All fields marked * are required",NULL);
	}
	else{
		if(Map::new_map($map_id, $name, $map_doc_id, $institution_id, $created_by)){
			if(isset($place_types)){
				PlaceType::save($map_id, $place_types);
			}
			jsonResponse(200,"Map Created",NULL);
		}
		else{
			jsonResponse(400,"Something went wrong...Please try again",NULL);
		}
	}

} 
else {
	jsonResponse(400,"Invalid Request",NULL);
}

?>