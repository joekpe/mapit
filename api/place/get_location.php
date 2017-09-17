<?php
	header("Content-Type:application/json");
	include_once("../../includes/includes.php");
	if(isset($_GET['name'])){
		$name = $database->prep($_GET['name']);
		$description = $database->prep(@$_GET['description']);
		$address = $database->prep(@$_GET['address']);
		$longitude = $database->prep($_GET['longitude']);
		$latitude = $database->prep($_GET['latitude']);
		$place_type = $database->prep($_GET['place_type']);
		$map_id = $database->prep($_GET['map_id']);
		$institution_id = $database->prep($_GET['institution_id']);
		$created_by = $database->prep($_GET['user_id']);

		if(	empty($name) and empty($longitude) and empty($latitude) and empty($map_id) and empty($institution_id) and empty($created_by)){
			jsonResponse(400, "All fields marked * are required", NULL); 
		}
		else{
			if(Place::exists($latitude, $longitude, $institution_id, $place_type)){
				jsonResponse(400, "Location already mapped for this institution", NULL);
			}
			else{
				if( Place::save($name, $description, $address, $latitude, $longitude, $place_type, $map_id, $institution_id, $created_by) ){
					jsonResponse(200, "Location saved to map", NULL);
				}
				else{
					jsonResponse(400, "Something went wrong...Try again", NULL);
				}
			}
		}
	
	}
	else{
		jsonResponse(400, "Invalid Request", NULL);
	}
?>