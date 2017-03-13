<?php
if($_SERVER['REQUEST_METHOD']=='POST') {

	//$patid = $_POST['patid'];
	$patid = '113649';
	//$visitdate = $_POST['visitdate'];
	$visitdate = '2016-12-06';
	//$reason = $_POST['reason'];
	$reason = 'Whooping cough';
	//$doctor = $_POST['doctor'];
	$doctor = 'Dr. Bub';
	
	$reponse = array();

	// connect to db
	require_once('db_config.php');

	$sql = "INSERT INTO visithistory (patid, visitdate, reason, doctor) VALUES('$patid','$visitdate','$reason', '$doctor')";

	// Write successful
	if ($con->query($sql) === TRUE) {
		$response["success"] = 1;
		$response["message"] = "Record created Successfully";
		echo json_encode($response);
	} else {
		// Write unsuccessful
		$response["success"] = 0;
		$repsonse["message"] = "An error occurred";
		echo json_encode($response);
	}


mysqli_close($con);
}
?>
