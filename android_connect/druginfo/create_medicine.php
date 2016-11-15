create_medicine.php
<?php
 
/*
 * Following code will create a new drug row
 * All product details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['drugid']) && isset($_POST['drugname']) && isset($_POST['drugtotal'])) {
 
    $drugid = $_POST['drugid'];
    $drugname = $_POST['drugname'];
    $drugtotal = $_POST['drugtotal'];
 
    // include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql inserting a new row
    $result = mysql_query("INSERT INTO druginfo(drugid, drugname, drugtotal) VALUES('$drugid', '$drugname', '$drugtotal')");
 
    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Drug successfully created.";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "An error occurred: Failed to insert row.";
 
        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>
