<?php
$name = "cutedog";
//$filename = $_POST['filePathColumn']
$filename = 'C:\Users\wildcat\Pictures';

$ftp_server = '192.168.0.100';
$ftp_user_name = 'elbluff';
$ftp_user_pass = 'Mayn0r';

//where you want to put the file on the webserver (elative to login dir)
$destination_file = '/var/www/html';

$connection_id = ftp_connect($ftp_server) or die('Could not connect.');

$login_result = ftp_login($connection_id, $ftp_user_name, $ftp_user_pass) or die('You do not have access to this ftp server.');

//check connection
//      if ((!connection_id) || (!$login_result)){
/////          echo "FTP Connection has failed.";
////          echo "Atempted to connect to $ftp_server for user $ftp_uder_name";
    //      exit;
      //} else{
        //  echo "Connected to $ftp_server, for user $ftp_user_name";
      //}

//upload file
$upload = ftp_put($connection_id, $destination_file.$name, $filename, FTP_BINARY);
    if(!$upload){
          echo "FTP upload of $filename has failed!";
    }else{
          echo "Uploading of $name completed successfully."
    }

//close connection
ftp_close($connection_id);

?>
