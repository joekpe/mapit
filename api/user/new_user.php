<?php
header("Content-Type:application/json");
include_once("../../includes/includes.php");
if( isset($_GET['name']) ) {
	$institution_id = 'INS-'.uniqid();
	$user_id = 'USR-'.uniqid();
	$full_name = $database->prep($_GET['name']);
	$email = $database->prep($_GET['email']);
	$phone = $database->prep($_GET['phone']);
	$pass1 = $database->prep($_GET['pass']);
	$pass2 = $database->prep($_GET['cpass']);
	$institution_name = $database->prep($_GET['institution']);
	$hash = md5(uniqid()."".date("Y-m-d H:i:s"));

	if( empty($full_name) or empty($email) or empty($phone) or empty($pass1) or empty($institution_name) ){
	  jsonResponse(400,"All fields marked * are required",NULL);
	}
	else{
	  if( filter_var($email, FILTER_VALIDATE_EMAIL) ){
	    if($pass1 === $pass2){
	      if(User::is_user($email)){
	        jsonResponse(400,"An account with that e-mail already exists",NULL);
	      }
	      else{
	        if(User::register($institution_id, $user_id, $full_name, $email, $pass1, $phone, $institution_name, $hash)){
	          jsonResponse(200,"Account Created...Check your e-mail for the activation link",NULL);
	        }
	        else{
	          jsonResponse(400,"Something went wrong...Please try again",NULL);
	        }
	      }
	    }
	    else{
	      jsonResponse(400,"Passwords Do Not Match",NULL);
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