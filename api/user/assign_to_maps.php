<?php
	header("Content-Type:application/json");
	include_once("../../includes/includes.php");
	if(isset($_GET['user_id'])){
		$user_id = $database->prep($_GET['user_id']);
		$institution_id = $database->prep($_GET['institution_id']);
		$map_ids = json_decode($_GET['map_ids']);
		
		if(	empty($user_id) and empty($institution_id) and empty($map_ids) ){
			jsonResponse(400, "All fields marked * are required", NULL); 
		}
		else{
			if(MapUser::assign_to_maps($map_ids, $user_id, $institution_id)){
				jsonResponse(200, "User assigned to map(s)", NULL); 
			}
		}
	
	}
	else{
		jsonResponse(400, "Invalid Request", NULL);
	}
?>