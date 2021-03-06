<?php
// Require Coppermine config file
require_once '../../include/config.inc.php';

// Connect to the server
$db_connection = new mysqli(
	$CONFIG['dbserver'],
	$CONFIG['dbuser'],
	$CONFIG['dbpass']
);
// Check if there was any error while connecting to the server
if ($db_connection->connect_error) {
	die("Connection failed: {$db_connection->connect_error}");
}

// Select Coppermine's database
$db_connection->select_db($CONFIG['dbname']);

// EOF
