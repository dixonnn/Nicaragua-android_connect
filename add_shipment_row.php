<?php

if($_SERVER['REQUEST_METHOD']=='POST') {
	
	//$drugid = $_POST['drugid'];
	$drugid = '555545';
	//$drugname = $_POST['drugname'];
	$drugname = 'REAL drugs';
  	//$shipdate = $_POST['shipdate'];
  	$shipdate = '2016-12-01';
	//$drugincr = $_POST['drugincr'];
	$drugincr = '500';

	$reponse = array();

	// connect to db
	require_once('db_config.php');

	$sql = "SELECT * FROM druginfo WHERE drugid=$drugid";
	$result = $con->query($sql);
	

        // Drug EXISTS -> UPDATE druginfo with increment
        if ($result->num_rows > 0) {
        	$response["exist_success"] = 1;
        	$response["exist_message"] = "Record created Successfully";

		$sql =  "UPDATE druginfo SET drugtotal = drugtotal+$drugincr";
                        
		// Update successful
                if ($con->query($sql) === TRUE) {
	        	$response["update_success"] = 1;
	                $response["update_message"] = "Record created Successfully";
			
		// Update unsuccessful
                } else { 
                        $response["update_success"] = 0;
                        $repsonse["update_message"] = "An error occurred";
                        echo json_encode($response);
                        exit();
                }
                	

	// Drug does not EXIST -> INSERT new drug row in druginfo
	} else {
        	$response["exist_success"] = 0;
           	$repsonse["exist_message"] = "Drug doesnt exist -> INSERT new row.";
		
		$sql = "INSERT INTO druginfo(drugid,drugname,drugtotal) VALUES ('$drugid', '$drugname','$drugincr') ";
                
		// Insert successful
                if ($con->query($sql) === TRUE) {
	        	$response["insert_success"] = 1;
	                $response["insert_message"] = "Record created Successfully";

		// Insert unsuccessful
                } else {
                        $response["insert_success"] = 0;
                        $repsonse["insert_message"] = "An error occurred";
                        echo json_encode($response);
                        exit();
                }
	
            	echo json_encode($response);
        }
	
	// If the program has gotten this far, it's time to insert a new shipment record
	$sql = "INSERT INTO shipment(shipdate, drugid, drugname, shipquant) VALUES ('$shipdate','$drugid','$drugname','$drugincr')";
                
	// Insert successful
        if ($con->query($sql) === TRUE) {
		$response["ship_success"] = 1;
                $response["ship_message"] = "Record created Successfully";
                echo json_encode($response);

	// Insert unsuccessful
        } else {
                $response["ship_success"] = 0;
                $repsonse["ship_message"] = "An error occurred";
                echo json_encode($response);
        }

	mysqli_close($con);
}
?>
