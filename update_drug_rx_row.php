<?php

if($_SERVER['REQUEST_METHOD']=='POST') {

	//$rxid = $_POST['rxid'];
	$rxid = '20';
	//$drugid = $_POST['drugid'];
	$drugid = '000002';
	//$transdate = $_POST['transdate'];
	$transdate = '2016-12-03';
	//$quantity = $_POST['quantity'];
	$quantity = '15';
	//$patid = $_POST['patid'];
	$patid = '113649';
	//$directions = $_POST['directions'];
	$directions = 'Take one daily.';
	//$duration = $_POST['duration'];
	$duration = '5 days.';
	//$doctor = $_POST['doctor'];
	$doctor = 'Dr. Jones';
	//$symptoms = $_POST['symptoms'];
	$symptoms = 'Couging, sneezing.';

	$response = array();

	// Connect to db
	require_once('db_config.php');

	// Get current quantity of prescribed drug from inventory
	$sql1 = "UPDATE druginfo SET drugtotal=drugtotal-$quantity WHERE drugid='$drugid'";

	// If updating drugtotal successful
	if ($con->query($sql1) === TRUE) {
		$response["update_success"] = 1;
		$response["update_message"] = "Record updated Successfully";

		// Create New Prescription entry
		$sql2 = "INSERT INTO prescription(rxid,drugid,transdate,quantity,patid,directions,duration,doctor,symptoms) VALUES('$rxid','$drugid','$transdate','$quantity','$patid','$directions','$duration',
'$doctor','$symptoms')";

		// Prescription creation successful
		if ($con->query($sql2) === TRUE) {
			$response["newrx_success"] = 1;				$response["newrx_message"] = "Prescription created successfully.";
			echo json_encode($response);

		// Prescription not created	
		} else {
			$response["newrx_success"] = 0;
			$response["newrx_message"] = "Prescription could not be created.";
			echo json_encode($response);
		}

	// Updating new drugtotal was not successful
	} else {
		$response["update_success"] = 0;
		$response["update_message"] = "Total not fetched.";
		echo json_encode($response);
	}


	
	

	
	mysqli_close($con);
}
?>
