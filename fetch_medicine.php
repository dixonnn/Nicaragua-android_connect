fetch_medicine.php
<?php
 
/*
 * Following code will get single drug details
 * A drug is identified with drug id (drugid)
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// check for post data
if (isset($_GET["drugid"])) {
    $drugid = $_GET['drugid'];
 
    // get a product from products table
    $result = mysql_query("SELECT * FROM druginfo WHERE drugid = $drugid");
 
    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
 
            $result = mysql_fetch_array($result);
 
            $product = array();
            $product["drugid"] = $result["drugid"];
            $product["drugname"] = $result["drugname"];
            $product["drugtotal"] = $result["drugtotal"];

            // success
            $response["success"] = 1;
 
            // user node
            $response["druginfo"] = array();
 
            array_push($response["druginfo"], $product);
 
            // echoing JSON response
            echo json_encode($response);
        } else {
            // no product found
            $response["success"] = 0;
            $response["message"] = "No drug found";
 
            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "No drug found";
 
        // echo no users JSON
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
