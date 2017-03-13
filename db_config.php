<?php
 
/*
 * All database connection variables
 */
 
define('DB_USER', "ElBluff1"); // db user
define('DB_PASSWORD', "Mayn0r"); // db password (mention your db password here)
define('DB_DATABASE', "hospital"); // database name
define('DB_SERVER', "localhost"); // db server

$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE) or die('Unable to connect: <db_config.php>');
?>
