<?php

if($_SERVER['REQUEST_METHOD']=='POST') {

	//$patname = $_POST['patname'];
	$patname = 'newpat4';
	//$patid = $_POST['patid'];
	$patid = 'patid4'; 
	//$address = $_POST['address'];
	$address = '641 Conny Road';
  	//$telephone = $_POST['telephone'];
	$telephone = '7727139924';
  	//$gender = $_POST['gender'];
	$gender = 'M';
  	//$marstat = $_POST['marstat'];
	$marstat = 'Single';
  	//$dob = $_POST['dob'];
	$dob = '1999-12-13';
  	//$children = $_POST['children'];
	$children = '3';
  	//$height = $_POST['height'];
	$height = '5';
  	//$weight = $_POST['weight'];
	$weight = '6';
  	//$allergies = $_POST['allergies'];
	$allergies = 'nope';
  	//$medcond = $_POST['medcond'];
	$medcond = 'ill';

  	$reponse = array();

	// connect to db
	require_once('db_config.php');

  	$sql = "INSERT INTO patientinfo (patname,patid,address,telephone,gender,
marstat,dob,children,height,weight,allergies,medcond) VALUES('$patname','$patid','$address','$telephone','$gender','$marstat','$dob','$children'
,'$height','$weight','$allergies','$medcond')";

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
