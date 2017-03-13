<?php

if($_SERVER['REQUEST_METHOD']=='POST') {

	//$rxid = $_POST['rxid'];
	$rxid = '4';
	//$drugid = $_POST['drugid'];
	$drugid = '000001';
	//$transdate = $_POST['transdate'];
	$transdate = '2016-04-05';
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
	$sql1 = "SELECT drugtotal FROM druginfo WHERE drugid='$drugid'";
	$result1 = $con->query($sql1);

	// If properly fetched...
	if ($result1->num_rows > 0) {
		// Assign value to $old_val, return confirmation
		$row1 = $result1->fetch_assoc();
		$old_val = $row1['drugtotal'];

		$response["fetch_success"] = 1;
		$response["fetch_message"] = "Old Total Fetched: " . $old_val;

	// If could not fetch...
	} else {
		$response["fetch_success"] = 0;
		$response["fetch_message"] = "Old drugtotal could not be fetched.";
		echo json_encode($response);
	}

	// So long as the old total has been fetched.
	if (isset ($old_val)) {
		$new_val = $old_val - $quantity;
		$sql2 = "UPDATE druginfo SET drugtotal='$new_val' WHERE 		drugid='$drugid'";
		
		// Update Successful
		if ($con->query($sql2) === TRUE) {
			$response["update_success"] = 1;
			$response["update_message"] = "Record updated Successfully";

			// Create New Prescription entry
			$sql3 = "INSERT INTO prescription(rxid,drugid,transdate,quantity,patid,directions,duration,doctor,symptoms) VALUES('$rxid','$drugid','$transdate','$quantity','$patid','$directions','$duration',
'$doctor','$symptoms')";

			// Prescription creation successful
			if ($con->query($sql3) === TRUE) {
				$response["newrx_success"] = 1;
				$response["newrx_message"] = "Prescription created successfully.";
				echo json_encode($response);
			// Prescription not created	
			} else {
				$response["newrx_success"] = 0;
				$response["newrx_message"] = "Prescription could not be created.";
				echo json_encode($response);
			}

		// Update Unsuccessful
		} else {
			$response["update_success"] = 0;
			$response["update_message"] = "Total not fetched.";
			echo json_encode($response);
		}
	} else {
		// Old total was not fetched.
		echo "Script stopped, could not fetch old total.";
	}
	
	

	
	mysqli_close($con);
}
?>
