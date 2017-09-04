<?php
header("Content-Type:application/json");
include_once("../../includes/includes.php");
if( isset($_GET['name']) ) {
	$map_doc_id = 'MPD-'.uniqid();
	$institution_id = $database->prep($_GET['institution_id']);
	$name = $database->prep($_GET['name']);
	$created_by = $database->prep($_GET['user_id']);

	if( empty($institution_id) or empty($name) or empty($created_by) ){
	  jsonResponse(400,"All fields marked * are required",NULL);
	}
	else{
		if(MapDoc::new_map_doc($map_doc_id, $name, $institution_id, $created_by)){
			jsonResponse(200,"Map Document Created",NULL);
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