<?php

$drugid = $_GET['drugid'];

$reponse = array();

// connect to db
require_once('db_config.php');

// Perform sql statement - Hardcoded
$sql = "SELECT * FROM druginfo WHERE drugid = '000001'";

// Perform sql statement - user input
// $sql = "SELECT * FROM druginfo WHERE drugid = '$drugid'";
$result = $con->query($sql);

	// Write successful
	if ($result->num_rows > 0) {
		
		$row = $result->fetch_assoc();

		$response["success"] = 1;
		$response["druginfo"] = array();
		array_push($response["druginfo"], $row);

		echo json_encode($response);
	} else {
		// Write unsuccessful
		$response["success"] = 0;
		$repsonse["message"] = "An error occurred";
		echo json_encode($response);
	}


$con->close();
?>
