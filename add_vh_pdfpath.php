<?php
if($_SERVER['REQUEST_METHOD']=='POST') {

	//$patid = $_POST['patid'];
	$patid = '113649';
	//$visitdate = $_POST['visitdate'];
	$visitdate = '2016-12-04';
	//$pdfpath = $_POST['pdfpath'];  ///the pdfpath variable is linked to the Android variable where the path is stored from the FTP
	$pdfpath = 'path5';
	
	$reponse = array();

	// connect to db
	require_once('db_config.php');

	$sql = "INSERT INTO pdf (patid, visitdate, pdfpath) VALUES('$patid','$visitdate','$pdfpath')";

	// Write successful
	if ($con->query($sql) === TRUE) {
		$response["success"] = 1;
		$response["message"] = "Record created Successfully";
		echo json_encode($response);
	} else {
		// Write unsuccessful
		$response["success"] = 0;
		$repsonse["message"] = "An error occurred";
		echo json_encode($response);
	}

	// Create HTML file for pdf viewing when called
	$htmlname = $pdfpath . ".html";
	$myfile = fopen($htmlname, "w") or die("Can't open file.");
	
	$txt = "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n";
	fwrite($myfile, $txt);
	
	$txt = "<body>\n";
	fwrite($myfile, $txt);

	$txt = "<embed src=\"http://192.168.0.100/";
	fwrite($myfile, $txt);
	fwrite($myfile, $pdfpath);

	$txt = "\" width=\"500\" height=\"750\" type='application/pdf'></embed>\n";
	fwrite($myfile, $txt);

	$txt = "</body>\n";
	fwrite($myfile, $txt);

	$txt = "</html>";
	fwrite($myfile, $txt);
	
	fclose($myfile);
	mysqli_close($con);
}
?>

