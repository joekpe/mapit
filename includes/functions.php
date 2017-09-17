<?php
	function redirect_to($location)
	{
		echo "<script type='text/javascript'> location.assign('".$location."'); </script>";
	}

	function jsonResponse($status,$status_message,$data) {
		//header("HTTP/1.1 ".$status_message);
		$response['status']=$status;
		$response['status_message']=$status_message;
		$response['values']=$data;
		$json_response = json_encode($response);
		echo $json_response;
	}


	function createMap($map_id){
		$link = "../../maps/";
		$map = fopen($link."".$map_id.".php", "w");
		$txt = '<?php
		include "../includes/includes.php";

		// Start XML file, create parent node

		$dom = new DOMDocument("1.0");
		$node = $dom->createElement("markers");
		$parnode = $dom->appendChild($node);

		$pla = Place::for_map("'.$map_id.'");

		header("Content-type: text/xml");
		while ($row = @mysqli_fetch_assoc($pla)){
		  // Add to XML document node
		  $node = $dom->createElement("marker");
		  $newnode = $parnode->appendChild($node);
		  $newnode->setAttribute("id",$row["place_id"]);
		  $newnode->setAttribute("name",$row["name"]);
		  $newnode->setAttribute("address", $row["address"]);
		  $newnode->setAttribute("lat", $row["latitude"]);
		  $newnode->setAttribute("lng", $row["longitude"]);
		  $newnode->setAttribute("type", "institution");
		}

		echo $dom->saveXML();
	?>';

	fwrite($map, $txt);
	fclose($map);
	}

?>