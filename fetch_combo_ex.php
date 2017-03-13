<?php
// $drugid = $_GET['drugid'];
// $drugid = '000002';

// $drugname = $_GET['drugname'];
// $drugname = 'Oxy';

// $shipdate = $_GET['shipdate'];
 $shipdate = '2016-01-01';

$reponse = array();

// connect to db
require_once('db_config.php');

// If date is set, this means we enabled the datepicker, suggesting
// that the user would like to search shipments. 
if (isset ($shipdate)) {
  echo '$shipdate is set. ';

  if (isset ($drugid)) { // specific drug by id on certain date
    echo '$drugid is set. ';
    $sql = "SELECT * FROM shipment WHERE shipdate = '$shipdate' and drugid = '$drugid'";
  }
  elseif (isset ($drugname)) { // specific drug by name on certain date
    echo '$drugname is set. ';
    $sql = "SELECT * FROM shipment WHERE shipdate = '$shipdate' and drugname = '$drugname'";
  }
  else { // all drugs delivered on certain date
    echo 'date and id not set. ';
    $sql = "SELECT * FROM shipment WHERE shipdate = '$shipdate'";
    $dateonly = 1;
  }

  $result = $con->query($sql);

  // Shipment fetch successful
  if ($result->num_rows > 0) {
    
    // Multiple rows
    if (isset ($dateonly)) {
      while ($row = $result->fetch_assoc()) {
        $response[] = $row;
      }
      $response["success"] = 1;
      echo json_encode($response);

    // Single Row
    } else {
		
      $row = $result->fetch_assoc();
      $response["success"] = 1;
      $response["shipment"] = array();
      array_push($response["shipment"], $row);
      echo json_encode($response);
    }

  } else { // Shipment fetch unsuccessful

    $response["success"] = 0;
    $repsonse["message"] = "An error occurred during shipment fetch.";
    echo json_encode($response);

  }
  $con->close();

} else { // Date is not set, search is of inventory by drug id or name

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
}
?>
