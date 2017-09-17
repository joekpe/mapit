<?php
	header("Content-Type:application/json");
	include_once("../../includes/includes.php");
	if(isset($_GET['email']) and isset($_GET['hash'])){
		$email  = $database->prep($_GET['email']);
		$hash = $database->prep($_GET['hash']);

		if(	empty($email) or empty($hash)){
			jsonResponse(400, "All fields marked * are required");
		}
		else{
			if( filter_var($email, FILTER_VALIDATE_EMAIL) ){
				
				if($database->query_db("UPDATE users SET active = ".YES." WHERE email = '".$email."' AND hash = '".$hash."' ")){
					jsonResponse(200,"Your account has been activated",NULL);
					
				}
				else{
					jsonResponse(400,"Something Went Wrong",NULL);
				}
			}
			else{
				jsonResponse(400,"Invalid E-mail",NULL);
			}
		}
	
	}
	else{
		jsonResponse(400, "Invalid Request", NULL);
	}
?>