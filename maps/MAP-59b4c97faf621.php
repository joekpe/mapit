<?php
		include "../includes/includes.php";

		// Start XML file, create parent node

		$dom = new DOMDocument("1.0");
		$node = $dom->createElement("markers");
		$parnode = $dom->appendChild($node);

		$pla = Place::for_map("MAP-59b4c97faf621");

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
	?>