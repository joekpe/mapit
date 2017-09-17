<?php
	header("Content-Type:application/json");
	include_once("../../includes/includes.php");
	if(isset($_GET['mapdoc_id'])){
		$mapdoc_id  = $database->prep($_GET['mapdoc_id']);

		if(	empty($mapdoc_id)){
			jsonResponse(400, "Unknown Map Doc", NULL);
		}
		else{
			$maps = $database->query_db("SELECT * FROM maps WHERE map_doc_id = '".$mapdoc_id."' ");
			if($database->num_rows($maps) > 0){
				$data = array();
				while ($rows = mysqli_fetch_assoc($maps)) {
					$data[] = $rows;
				}

				jsonResponse(200, "Available Maps", $data);
			}
			else{
				jsonResponse(400, "No Maps Available", NULL);
			}
		}
	
	}
	else{
		jsonResponse(400, "Invalid Request", NULL);
	}
?>