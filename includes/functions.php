<?php
	function redirect_to($location)
	{
		echo "<script type='text/javascript'> location.assign('".$location."'); </script>";
	}

	function jsonResponse($status,$status_message,$data) {
		header("HTTP/1.1 ".$status_message);
		$response['status']=$status;
		$response['status_message']=$status_message;
		$response['data']=$data;
		$json_response = json_encode($response);
		echo $json_response;
	}

?>