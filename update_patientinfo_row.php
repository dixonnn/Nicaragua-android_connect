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
	$sql = "UPDATE patientinfo
          SET patname='Chris Dixon'
              address='641 Conestoga'
              telephone='7726962517'
              gender='M'
              marstat='S'
              dob='03021995'
              children='3'
              height='200'
              weight='100'
              allergies='work'
              medcond='ill'
          WHERE patid='113649'";
  
	// Perform sql statement - User Input
  	/*$sql = "UPDATE patientinfo
          SET patname='$patname'
              address='$address'
              telephone='$telephone'
              gender='$gender'
              marstat='$marstat'
              dob='$dob'
              children='$children'
              height='$height'
              weight='$weight'
              allergies='$allergies'
              medcond='$medcond'
          WHERE patid='$patid'"; */

	// Update successful
	if ($con->query($sql) === TRUE) {
		$response["success"] = 1;
		$response["message"] = "Record updated Successfully";
		echo json_encode($response);
	} else {
		// Update unsuccessful
		$response["success"] = 0;
		$repsonse["message"] = "An error occurred";
		echo json_encode($response);
	}
mysqli_close($con);
}
?>
