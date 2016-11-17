<?php

//Getting variables
//$__ is the string name and the ['__'] has temporarily been set
//as the database value. 
$patID = $_GET['patid'];


//Importing database
require_once('db_config.php');

//Creating sql query with where clause to get info
$sql = "SELECT * FROM patientinfo WHERE patID = $patid';

//getting result
$r = mysqli_query($con,$sql);

//push result to array
$result = array();
$row = mysqli_fetch_array($r);

array_push($result,array(
	$row = $result->fetch_assoc();
 )); 

//displaying in json format
echo json_encode(array('result'=>$result));

mysqli_close($con);

?>