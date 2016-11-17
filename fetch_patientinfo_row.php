<?php

//Getting variables
//$__ is the string name and the ['__'] has temporarily been set
//as the database value. 
$patid = $_GET['patid'];

$response = array();

//Importing database
require_once('db_config.php');

//Creating sql query with where clause to get info - hard-coded
$sql = "SELECT * FROM patientinfo WHERE patid = '113649'";

//Creating sql query with where clause to get info - user input
//$sql = "SELECT * FROM patientinfo WHERE patID = $patid';

//getting result
$result = $con->query($sql);

// Fetch Successful
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();

	$response["success"] = 1;
	$response["patientinfo"] = array();
	array_push($response["patientinfo"], $row);

	echo json_encode($response);
} else {
	// Fetch not successful
	$response['success'] = 0;
	$response['patientinfo'] = "An error occurred";
	echo json_encode($response);
}

mysqli_close($con);
?>
