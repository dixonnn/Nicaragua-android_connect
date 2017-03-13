<?php

if($_SERVER['REQUEST_METHOD']=='POST') {

	//$patname = (isset($_POST['patname']) ? $_POST['patname'] : null);
	//$patname = $_POST['patname'];
	$patname = 'newpat5';
	
	//$patid=$_POST['patid'];
	//$patid = (isset($_POST['patid']) ? $_POST['patid'] : null);
	$patid = 'patid5'; 

	//$address=$_POST['address'];
	//$address = (isset($_POST['address']) ? $_POST['address'] : null);
	$address = '6413 Conny Road';

	//$telephone=$_POST['telephone'];
  	//$telephone = (isset($_POST['telephone']) ? $_POST['telephone'] : null);
	$telephone = '7733349924';

	//$gender=$_POST['gender'];
  	//$gender = (isset($_POST['gender']) ? $_POST['gender'] : null);
	$gender = 'M';

	//$marstat=$_POST['marstat'];
  	//$marstat = (isset($_POST['marstat']) ? $_POST['marstat'] : null);
	$marstat = 'Single';

	//$dob=$_POST['dob'];
  	//$dob = (isset($_POST['dob']) ? $_POST['dob'] : null);
	$dob = '1999-12-13';

	//$children=$_POST['children'];
  	//$children = (isset($_POST['children']) ? $_POST['children'] : null);
	$children = '3';

	//$height=$_POST['height'];
  	//$height = (isset($_POST['height']) ? $_POST['height'] : null);
	$height = '5';

	//$weight=$_POST['weight'];
  	//$weight = (isset($_POST['weight']) ? $_POST['weight'] : null);
	$weight = '6';
  	
	//$allergies=$_POST['allergies'];	
	//$allergies = (isset($_POST['allergies']) ? $_POST['allergies'] : null);
	$allergies = 'nope';

	//$medcond=$_POST['medcond'];
  	//$medcond = (isset($_POST['medcond']) ? $_POST['medcond'] : null);
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
