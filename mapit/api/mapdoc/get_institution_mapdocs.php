<?php
	header("Content-Type:application/json");
	include_once("../../includes/includes.php");
	if(isset($_GET['institution_id'])){
		$institution_id  = $database->prep($_GET['institution_id']);

		if(	empty($institution_id)){
			jsonResponse(400, "Unknown Institution");
		}
		else{
			$map_docs = $database->query_db("SELECT * FROM map_docs WHERE institution_id = '".$institution_id."' ");
			if($database->num_rows($map_docs) > 0){
				$data = array();
				while ($rows = mysqli_fetch_assoc($map_docs)) {
					$data[] = $rows;
				}

				jsonResponse(200, "Available Map Docs", $data);
			}
			else{
				jsonResponse(400, "No Map Docs Available", NULL);
			}
		}
	
	}
	else{
		jsonResponse(400, "Invalid Request", NULL);
	}
?>