<?php
$drugid = $_GET['drugid'];
$drugname = $_GET['drugname'];
$date = $_GET['date'];

$reponse = array();
// connect to db
require_once('db_config.php');

if (isset ($date)){
  // Perform sql statement - Hardcoded
  if(isset ($drugid)){
    $sql = "SELECT * FROM shipment WHERE date = '000001' and drugid = '000001'";
  }
  else{
    $sql = "SELECT * FROM shipment WHERE date = '000001' and drugname = 'tylenol'";
  }
  // Perform sql statement - user input
  // $sql = "SELECT * FROM shipment WHERE date = '$date'";
}
else{
  if(isset ($drugid)){
    $sql = "SELECT * FROM druginfo WHERE drugid = '000001'";
  }
  else{
    $sql = "SELECT * FROM druginfo WHERE drugname = 'tylenol'";
  }

}

$result = $con->query($sql);
	// Write successful
	if ($result->num_rows > 0) {
		
		$row = $result->fetch_assoc();
		$response["success"] = 1;
		$response["druginfo"] = array();
		array_push($response["druginfo"], $row);
		echo json_encode($response);
	} else {
		// Write unsuccessful
		$response["success"] = 0;
		$repsonse["message"] = "An error occurred";
		echo json_encode($response);
	}
$con->close();
?>
