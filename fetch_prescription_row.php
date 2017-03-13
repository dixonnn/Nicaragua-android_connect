<?php

// $patid = $_GET['patid'];
$patid = 'patid0';

$response = array();

//connect to db
require_once('db_config.php');

$sql = "SELECT * FROM prescription WHERE patid = '$patid'";

$result = $con -> query($sql);

  //Write successful
    if($result -> num_rows > 0){
        $row = $result -> fetch_assoc();
        $response["success"] = 1;
        $response["prescription"] = array();
        array_push($response["prescription"], $row);
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
