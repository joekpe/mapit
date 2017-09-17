<?php
	header("Content-Type:application/json");
	include_once("../../includes/includes.php");
	if(isset($_GET['user_id']) and isset($_GET['institution_id'])){
		$user_id  = $database->prep($_GET['user_id']);
		$institution_id = $database->prep($_GET['institution_id']);

		if(	empty($user_id) or empty($institution_id)){
			jsonResponse(400, "Unknown User or Insitution", NULL);
		}
		else{
			$maps = MapUser::get_user_maps($user_id, $institution_id);
			if($database->num_rows($maps) > 0){
 				$data = array();
				while($rows = mysqli_fetch_assoc($maps)){

				
					$data[] = $rows;

				}

				jsonResponse(200, "Maps Available", $data);
			}
			else{
				jsonResponse(400, "User not assigned to any map", NULL);
			}
			
		}
	
	}
	else{
		jsonResponse(400, "Invalid Request", NULL);
	}
?>