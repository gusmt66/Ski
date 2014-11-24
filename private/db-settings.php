<?php

//Database Information LOCAL

$db_host = "localhost"; //Host address (most likely localhost)
$db_name = "skibd"; //Name of Database
$db_user = "root"; //Name of database user
$db_pass = ""; //Password for database user
$db_table_prefix = "";


//En servidor SKI
/*$db_host = "localhost"; //Host address (most likely localhost)
$db_name = "skicomve_skicomve"; //Name of Database
$db_user = "skicomve_user"; //Name of database user
$db_pass = "TlKxvC&#q&PM"; //Password for database user
$db_table_prefix = "";
*/
GLOBAL $errors;
GLOBAL $successes;

$errors = array();
$successes = array();

/* Create a new mysqli object with database connection parameters */
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
$mysqli->set_charset("utf8");
GLOBAL $mysqli;

if(mysqli_connect_errno()) {
	echo "Connection Failed: " . mysqli_connect_errno();
	exit();
}

?>