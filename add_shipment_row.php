<?php
//The purpose of this script is to update drug quantities. The script checks if the
//drug id already exists.
//     If YES, update quantities.
//     If NO, add new row.
//A new shipment entry is created regardless of if the medicine is new of existing.


if($_SERVER['REQUEST_METHOD']=='POST') {
	//$drugid = $_POST['drugid'];
	$drugid = '123123';
	//$drugname = $_POST['drugname'];
	$drugname = 'fakedrug';
	//$drugtotal = $_POST['drugtotal'];
	$drugtotal = '30';
  //$shipdate = $_POST['__']************
  $shipdate = $_POST['12/1/2016']

	$reponse = array();
	// connect to db
	require_once('db_config.php');


$sql = "SELECT EXISTS(SELECT * FROM druginfo WHERE drugid = '$drugid')";
$result = $con->query($sql);

          // Write successful
          if ($result) === TRUE) {
            $response["exist_success"] = 1;
            $response["exist_message"] = "Record created Successfully";

                            $row = $result->fetch.assoc();
                            $flag = $row['EXISTS(SELECT * FROM druginfo WHERE drugid = '$drugid')'];

                            if($flag == 1){
                            $sql =  "UPDATE drugtotal SET drugtotal = drugtotal+$drugtotal";
                                      // Write successful
                                      if ($con->query($sql) === TRUE) {
                                        $response["update_success"] = 1;
                                        $response["update_message"] = "Record created Successfully";
                                      } else {
                                        // Write unsuccessful
                                        $response["update_success"] = 0;
                                        $repsonse["update_message"] = "An error occurred";
                                        echo json_encode($response);
                                        exit();
                                      }

                            }else{
                              $sql = "INSERT INTO druginfo(drugid,drugname,drugtotal) VALUES ('$drugid', '$drugname','$drugtotal') ";
                                      // Write successful
                                      if ($con->query($sql) === TRUE) {
                                        $response["insert_success"] = 1;
                                        $response["insert_message"] = "Record created Successfully";
                                      } else {
                                        // Write unsuccessful
                                        $response["insert_success"] = 0;
                                        $repsonse["insert_message"] = "An error occurred";
                                        echo json_encode($response);
                                        exit();
                                      }

                            }

                            $sql = "INSERT INTO shipment(shipdate, drugid, drugname, shipquant) VALUES ('$shipdate','$drugid','$drugname','$drugtotal')";
                                    // Write successful
                                    if ($con->query($sql) === TRUE) {
                                      $response["ship_success"] = 1;
                                      $response["ship_message"] = "Record created Successfully";
                                      echo json_encode($response);
                                    } else {
                                      // Write unsuccessful
                                      $response["ship_success"] = 0;
                                      $repsonse["ship_message"] = "An error occurred";
                                      echo json_encode($response);
                                    }

}
  else {
            // Write unsuccessful
            $response["exist_success"] = 0;
            $repsonse["exist_message"] = "An error occurred";
            echo json_encode($response);
          }
          mysqli_close($con);
}
?>
