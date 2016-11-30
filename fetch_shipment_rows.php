<?php
// $drugid = $_GET['drugid'];
// $drugid = '000007';

// $drugname = $_GET['drugname'];
 $drugname = 'Oxy';

// $shipdate = $_GET['shipdate'];
 $shipdate = '2016-01-01';

// $by_drug is set according to the presence of a drug modifier
// 0 = search only by date (no drug modifier)
// 1 = search by ID
// 2 = search by Name

if (empty($drugid) && empty($drugname)) {
  $by_drug = 0;
} elseif (isset ($drugid)) {
  $by_drug = 1;
} else {
  $by_drug = 2;
}

$reponse = array();

// connect to db
require_once('db_config.php');

/* --- Date AND Drug --- */
if (isset ($shipdate) && $by_drug !== 0) {
  
  if ($by_drug == 1) {
    $sql = "SELECT * FROM shipment WHERE shipdate='$shipdate' and drugid='$drugid'";
  } else {
    $sql = "SELECT * FROM shipment WHERE shipdate='$shipdate' and drugname='$drugname'";
  }

  $result = $con->query($sql);
  
  // Fetch successful
  if ($result->num_rows > 0) {
  
    $row = $result->fetch_assoc();
    $response["success"] = 1;
    $response["shipment"] = array();
    array_push($response["shipment"], $row);
    echo json_encode($response);

  // Fetch unsuccessful
  } else {
    
    $response["success"] = 0;
    $repsonse["message"] = "An error occurred during shipment fetch.";
    echo json_encode($response);

  }
  $con->close();


/* --- Date OR Drug --- */
} else {

  if ($by_drug == 1) {
    $sql = "SELECT * FROM shipment WHERE drugid='$drugid'";
  } elseif ($by_drug == 2) {
    $sql = "SELECT * FROM shipment WHERE drugname='$drugname'";
  } else {
    $sql = "SELECT * FROM shipment WHERE shipdate='$shipdate'";
  }

  $result = $con->query($sql);

  // Fetch Successful
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

}
?>
