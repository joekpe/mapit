<?php
	header("Content-type: application/json");
	include '../../includes/includes.php';
	if(isset($_GET['map_id'])){
		$institution_id = $database->prep($_GET['institution_id']);
		$map_id = $database->prep($_GET['map_id']);
		if(empty($institution_id) or empty($map_id)){
			jsonResponse(400, "Unknown Institution/Map", NULL);
		}
		else{
			$result = Place::get_places_for_map($institution_id, $map_id);
			if($database->num_rows($result) > 0){
				# Build GeoJSON feature collection array
				$geojson = array(
				   'type'      => 'FeatureCollection',
				   'features'  => array()
				);

				# Loop through rows to build feature arrays
				while ($row = mysqli_fetch_assoc($result)) {
				    $properties = $row;
				    # Remove latitude and longitude fields from properties (optional)
				    unset($properties['latitude']);
				    unset($properties['longitude']);
				    $feature = array(
				        'type' => 'Feature',
				        'geometry' => array(
				            'type' => 'Point',
				            'coordinates' => array(
				                $row['latitude'],
				                $row['longitude']
				            )
				        ),
				        'properties' => $properties
				    );
				    # Add feature arrays to feature collection array
				    array_push($geojson['features'], $feature);
				}

				header('Content-type: application/json');
				//echo json_encode($geojson, JSON_NUMERIC_CHECK);
				jsonResponse(200, "Places mapped", $geojson);
				// print_r($geojson);
			}
			else{
				jsonResponse(400, "Nothing Available", NULL);
			}
		}
	}
	else{
		jsonResponse(400, "Invalid Request", NULL);
	}

?>