<?php
	header("Content-Type:application/json");
	include_once("../../includes/includes.php");
	if(isset($_GET['map_id'])){
		$map_id  = $database->prep($_GET['map_id']);

		if(	empty($map_id)){
			jsonResponse(400, "Unknown Map", NULL);
		}
		else{
			$place_types = $database->query_db("SELECT place_type_id, place_type FROM place_types WHERE map_id = '".$map_id."' ");
			if($database->num_rows($place_types) > 0){
				$data = array();
				while ($rows = mysqli_fetch_assoc($place_types)) {
					$data[] = $rows;
				}

				jsonResponse(200, "Available Place Types", $data);
			}
			else{
				jsonResponse(400, "No Place Types Available For This Map", NULL);
			}
		}
	
	}
	else{
		jsonResponse(400, "Invalid Request", NULL);
	}
?>