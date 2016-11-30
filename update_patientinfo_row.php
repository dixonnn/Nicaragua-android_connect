<?php
if($_SERVER['REQUEST_METHOD']=='POST') {

	//$patname = $_POST['patname'];
	$patname = 'Chris Dixon';
	//$patid = $_POST['patid'];
	$patid = '113649';
	//$address = $_POST['address'];
	$address = '641 Conestoga';
  	//$telephone = $_POST['telephone'];
	$telephone = '7726962517';
  	//$gender = $_POST['gender'];
	$gender = 'M';
  	//$marstat = $_POST['marstat'];
	$marstat = 'S';
  	//$dob = $_POST['dob'];
	$dob = '1995-02-03';
  	//$children = $_POST['children'];
	$children = '3';
  	//$height = $_POST['height'];
	$height = '20';
  	//$weight = $_POST['weight'];
	$weight = '10';
  	//$allergies = $_POST['allergies'];
	$allergies = 'work';
  	//$medcond = $_POST['medcond'];
	$medcond = 'ill';
  	
	$reponse = array();

	// connect to db
	require_once('db_config.php');

  	$sql = "UPDATE patientinfo
          SET patname='$patname',
              address='$address',
              telephone='$telephone',
              gender='$gender',
              marstat='$marstat',
              dob='$dob',
              children='$children',
              height='$height',
              weight='$weight',
              allergies='$allergies',
              medcond='$medcond'
          WHERE patid='$patid'"; 

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
