<?php
if($_SERVER['REQUEST_METHOD']=='POST') {

	$drugid = $_POST['drugid'];
	$drugname = $_POST['drugname'];
	$drugtotal = $_POST['drugtotal'];
	$reponse = array();

	// connect to db
	require_once('db_config.php');

	// Perform sql statement - Hard Coded
	$sql = "INSERT INTO druginfo (drugid,drugname,drugtotal) VALUES('11139','Fscytre','633')";
	
	// Perform sql statement - User input
	//$sql = "INSERT INTO druginfo (drugid,drugname,drugtotal) VALUES('$drugid','$drugname','$drugtotal')";

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
