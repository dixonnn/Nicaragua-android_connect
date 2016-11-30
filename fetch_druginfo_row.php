<?php
// $drugid = $_GET['drugid'];
 $drugid = '000002';

// $drugname = $_GET['drugname'];
// $drugname = 'Oxy';

$reponse = array();

// connect to db
require_once('db_config.php');

if(isset ($drugid)){ // by id
  $sql = "SELECT * FROM druginfo WHERE drugid = '$drugid'";
}
else { // by name
  $sql = "SELECT * FROM druginfo WHERE drugname = '$drugname'";
}

$result = $con->query($sql);

// Inventory fetch successful
if ($result->num_rows > 0) {
		
  $row = $result->fetch_assoc();
  $response["success"] = 1;
  $response["druginfo"] = array();
  array_push($response["druginfo"], $row);
  echo json_encode($response);

} else { // Inventory fetch unsuccessful

  $response["success"] = 0;
  $repsonse["message"] = "An error occurred during inventory fetch.";
  echo json_encode($response);

}
$con->close();

?>
