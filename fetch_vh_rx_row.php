<?php

//$patid = $_GET['patid'];
$patid = '113649';
//$visitdate = $_GET['visitdate'];
$visitdate = '2016-12-03';

$response = array();

//connect to db
require_once('db_config.php');

$sql1 = "SELECT * FROM visithistory WHERE patid='$patid' and visitdate='$visitdate'";

$sql2 = "SELECT * FROM prescription p,druginfo d WHERE patid='$patid' and transdate='$visitdate' and p.drugid=d.drugid";

$result1 = $con->query($sql1);

  //Write successful
    if($result1->num_rows > 0){
        $row = $result1->fetch_assoc();
        $response["success"] = 1;
        $response["fetch_visit"] = array();
        array_push($response["fetch_visit"], $row);
       
  //Write unsuccessful
    } else {
        $response["success"] = 0;
        $response["fetch_visit"] = "An error occurred";
      }

$result2 = $con->query($sql2);

  //Write successful
    if($result2->num_rows > 0) {
        $response["success"] = 1;
	while ($row = $result2->fetch_assoc()) {
		$response["fetch_rx"][] = $row;
	}
        echo json_encode($response);

  //Write unsuccessful
    } else {
        $response["success"] = 0;
        $response["fetch_rx"] = "An error occurred";
        echo json_encode($response);
      }

  $con -> close();
?>
