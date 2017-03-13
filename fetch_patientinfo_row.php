<?php


$patid = $_GET['patid'];
//$patid = 'patid1';


if(isset ($patid)) { 

} else {

$patid='%';
}

$response = array();

//Importing database
require_once('db_config.php');

$sql = "SELECT * FROM patientinfo WHERE patid LIKE '$patid'";

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
