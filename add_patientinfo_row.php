<?php

if($_SERVER['REQUEST_METHOD']=='POST') {

	$patname = $_POST['patname'];
	$patid = $_POST['patid'];
	$address = $_POST['address'];
  	$telephone = $_POST['telephone'];
  	$gender = $_POST['gender'];
  	$marstat = $_POST['marstat'];
  	$dob = $_POST['dob'];
  	$children = $_POST['children'];
  	$height = $_POST['height'];
  	$weight = $_POST['weight'];
  	$allergies = $_POST['allergies'];
  	$medcond = $_POST['medcond'];
  	$reponse = array();

	// connect to db
	require_once('db_config.php');

	// Perform sql statement - Hard Coded
	$sql = "INSERT INTO patientinfo (patname,patid,address,telephone,gender,
  marstat,dob,children,height,weight,allergies,medcond) VALUES('TestPat1','patid1',
  '633 Beachomber Lane','7726962517','M','S','1995-03-02','2','100','50','none',
  'sick')";

	// Perform sql statement - User input
  	//$sql = "INSERT INTO patientinfo (patname,patid,address,telephone,gender,
  	//marstat,dob,children,height,weight,allergies,medcond) VALUES('$patname','$patid',
  		//'$address','$telephone','$gender','$marstat','$dob','$children','$height','$weight','$allergies',
  	//'$medcond')";

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
