<?php
	header("Content-Type:application/json");
	include_once("../../includes/includes.php");
	if(isset($_GET['email']) and isset($_GET['password'])){
		$email  = $database->prep($_GET['email']);
		$password = $database->prep($_GET['password']);

		if(	empty($email) or empty($password)){
			jsonResponse(400, "All fields marked * are required");
		}
		else{
			if( filter_var($email, FILTER_VALIDATE_EMAIL) ){
				$user = $database->query_db("SELECT * FROM users WHERE email = '".$email."' AND password = '".sha1($password)."' ");
				if($database->num_rows($user) == 1){
					$data = array();
					$row = mysqli_fetch_assoc($user);
					if($row['active'] == NO){
						jsonResponse(400,"Account Inactive",NULL);
					}
					else{
						$data[] = $row;

						jsonResponse(200,"Login Successful",$data);
					}
				}
				else{
					jsonResponse(400,"Invalid Credentials",NULL);
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