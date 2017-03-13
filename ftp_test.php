<?php
//$name = "cutedog";
//$filename = $_POST['filePathColumn']

$patid = '113649';
$visitdate = '2016-12-03';

$sql = 'SELECT pdfpath FROM pdf WHERE patid = $patid and pdfpath = $pdfpath';

$filename = '$sql';
$ftp_server = '192.168.0.100';
$ftp_user_name = 'elbluff';
$ftp_user_pass = 'Mayn0r';

//where you want to put the file on the webserver (elative to login dir)
	$destination_file = '/var/www/html/pdfs/cutedog.jpg';
	$connection_id = ftp_connect($ftp_server) or die('Could not connect.');
	$login_result = ftp_login($connection_id, $ftp_user_name, $ftp_user_pass) 	or die('You do not have access to this ftp server.');

//upload file
	$upload = ftp_put($connection_id, $destination_file, $filename, FTP_ASCII);
    	if(!$upload){
          	echo "FTP upload of $filename has failed!";
   	}else{
          	echo "Uploading of $name completed successfully.";
    	}

//close connection
ftp_close($connection_id);
?>
