<?php
//$patid = $_GET['patid'];
$patid = '113649';

$response = array();

//connect to db
require_once('db_config.php');

$sql = "SELECT * FROM visithistory v, prescription p WHERE v.patid = '$patid' and v.rxid = p.rxid";

$result = $con -> query($sql);

  //Write successful
    if($result -> num_rows > 0){
        $row = $result -> fetch_assoc();
        $response["success"] = 1;
        $response["visithistory_rx"] = array();
        array_push($response["visithistory_rx"], $row);
        echo json_encode($response);
        }
  //Write unsuccessful
      else{
        $response["success"] = 0;
        $response["message"] = "An error occurred";
        echo json_encoder($response);
      }
  $con -> close();
?>
