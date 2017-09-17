<?php
	header("Content-Type:application/json");
	include_once("../../includes/includes.php");
	if(isset($_GET['user_id'])){
		$user_id  = $database->prep($_GET['user_id']);

		if(	empty($user_id)){
			jsonResponse(400, "Unknown User", NULL);
		}
		else{
			$user_institutions = $database->query_db("SELECT user_institutions.institution_id, user_institutions.access_level, institutions.institution_name FROM user_institutions LEFT JOIN institutions ON user_institutions.institution_id = institutions.institution_id WHERE user_institutions.user_id = '".$user_id."' ");
			$data = array();
			while($rows = mysqli_fetch_assoc($user_institutions)){

			
				$data[] = $rows;

			}

			jsonResponse(200, "Institutions Available", $data);
		}
	
	}
	else{
		jsonResponse(400, "Invalid Request", NULL);
	}
?>