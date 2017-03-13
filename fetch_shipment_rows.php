<?php

  //$drugid = $_GET['drugid'];
  $drugid = (isset($_GET['drugid']) ? $_GET['drugid'] : null);
  // $drugid = '000007';

  //$drugname = $_GET['drugname'];
  $drugname = (isset($_GET['drugname']) ? $_GET['drugname'] : null);
  //$drugname = 'Oxy';

  //$shipdate = $_GET['shipdate'];
  $shipdate = (isset($_GET['shipdate']) ? $_GET['shipdate'] : null);

  //$shipdate = '2016-01-01';

  $reponse = array();

  if (empty ($drugid)) { 
    $drugid = '%';
  }

  if (empty ($drugname)) {
    $drugname = '%';
  } 

  // connect to db
  require_once('db_config.php');

  if (empty($shipdate)) {
    
    $low = '1000-01-01';
    $high = '9999-01-01';
  } else {
   
    $low = $shipdate;
    $high = $shipdate;
  }

  $sql = "SELECT * FROM shipment
          WHERE drugid LIKE '$drugid'
            AND drugname LIKE '$drugname'
            AND shipdate >= '$low'
            AND shipdate <= '$high'";

  $result = $con->query($sql);
  
  // Fetch successful
  if ($result->num_rows > 0) {
  
    $response["success"] = 1;
    while ($row = $result->fetch_assoc()) {
      $response["shipment"][] = $row;
    }
    echo json_encode($response);

  // Fetch unsuccessful
  } else {
    
    $response["success"] = 0;
    $repsonse["message"] = "An error occurred during shipment fetch.";
    echo json_encode($response);

  }

  $con->close();

?>
