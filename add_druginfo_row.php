<?php
if($_SERVER['REQUEST_METHOD']=='POST') {

	//$drugid = $_POST['drugid'];
	$drugid = '123123';
	//$drugname = $_POST['drugname'];
	$drugname = 'fakedrug';
	//$drugtotal = $_POST['drugtotal'];
	$drugtotal = '500';
	
	$reponse = array();

	// connect to db
	require_once('db_config.php');

	$sql = "INSERT INTO druginfo (drugid,drugname,drugtotal) VALUES('$drugid','$drugname','$drugtotal')";

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
