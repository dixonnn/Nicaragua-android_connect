<?php
$drugid = $_GET['drugid'];
$drugname = $_GET['drugname'];

$reponse = array();

// connect to db
require_once('db_config.php');


if(isset ($drugid)) { 

} else {

$drugid='%';
}

if(isset ($drugname)) {

} else {

$drugname='%';
}

$sql = "SELECT * FROM druginfo WHERE drugid LIKE '$drugid' and drugname LIKE '$drugname'";


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
