<?php
header("Content-Type:application/json");
include_once("../../includes/includes.php");
if( isset($_GET['name']) ) {
	$user_id = 'USR-'.uniqid();
	$full_name = $database->prep($_GET['name']);
	$email = $database->prep($_GET['email']);
	$phone = $database->prep($_GET['phone']);
	$pass = $database->prep($_GET['pass']);
	$institution_id = $database->prep($_GET['institution_id']);
	$map_ids = json_decode(@$_GET['map_ids']);

	if( empty($full_name) or empty($email) or empty($phone) or empty($pass) or empty($institution_id) ){
	  jsonResponse(400,"All fields marked * are required",NULL);
	}
	else{
	  if( filter_var($email, FILTER_VALIDATE_EMAIL) ){
	    
	      if(User::is_user($email)){
	      	$u = User::find_by_email($email);
	      	$user = $database->fetch_array($u);
	      	if(UserInstitution::exists($user['user_id'], $institution_id)){
	      		jsonResponse(400,"A user with this email(".$email.") already exists in this institution",NULL);
	      	}
	      	else{
	      		if(UserInstitution::save($user['user_id'], $institution_id, CLIENT) ){
	      			if(isset($map_ids)){
	      				MapUser::assign_to_maps($map_ids, $user['user_id'], $institution_id);
	      			}
	      			jsonResponse(200,"User Added To Institution",NULL);
		        }
		        else{
		        	jsonResponse(400,"Something went wrong...Please try again",NULL);
		        }
	      	}
	      }
	      else{
	        if(User::create_client($institution_id, $user_id, $full_name, $email, $pass, $phone) ){
	        	if(isset($map_ids)){
      				MapUser::assign_to_maps($map_ids, $user['user_id'], $institution_id);
      			}
	          jsonResponse(200,"User Created",NULL);
	        }
	        else{
	          jsonResponse(400,"Something went wrong...Please try again",NULL);
	        }
	      }
	    
	  }
	  else{
	    jsonResponse(400,"Invalid E-mail",NULL);
	  }
	}

} 
else {
	jsonResponse(400,"Invalid Request",NULL);
}

?>