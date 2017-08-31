<?php
header("Content-Type:application/json");
include_once("../includes/includes.php");
if(isset($_GET['name']) and strlen($_GET['name']) > 0 ) {
	$name=$_GET['name'];
	$items = getItems($name);

	if(empty($items)) {
		jsonResponse(200,"Items Not Found",NULL);
	} 
	else {
		jsonResponse(200,"Item Found",$items);
	}
} 
else {
	jsonResponse(400,"Invalid Request",NULL);
}

function getItems($name) {
	global $database;
	$sql = "SELECT * FROM products WHERE name LIKE '%".$name."%' ";
	$resultset = $database->query_db($sql);
	$data = array();
	while( $rows = mysqli_fetch_assoc($resultset) ) {
		$data[] = $rows;
	}
	return $data;
}
?>