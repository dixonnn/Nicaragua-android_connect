<?php
if($_SERVER['REQUEST_METHOD']=='POST') {
$reponse = array();

// connect to db
require_once('db_config.php');

// Initialize sql statement
$sql = "SELECT * FROM druginfo";

// designate variable to hold query results
$result = $con->query($sql);

	// If Rows returned
	if ($result->num_rows > 0) {
		
		// While the current row is populated, nest it in $response
		// Will stop once all rows have been operated upon
                $response["success"] = 1;
		while ($row = $result->fetch_assoc()) {
			$response["druginfo"][] = $row;
		}
		echo json_encode($response);
	} else {
		// No rows returned
		$response["success"] = 0;
		$repsonse["message"] = "An error occurred";
		echo json_encode($response);
	}

// close db connection
$con->close();
}
?>
