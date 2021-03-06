<?php
// API Variables
require_once '../api-variables.php';
// DB Connection
require_once '../db-connection.php';
// CPG Variables
require_once '../cpg-variables.php';

// Query albums & pictures tables
$albums_pictures_query = $db_connection->prepare(
	"SELECT p.filename, p.filepath, p.aid, p.pid, a.title, a.category FROM {$pictures_table} p
	JOIN {$albums_table} a ON p.aid = a.aid
	WHERE visibility = 0
	AND approved = 'YES'
	AND category {$category_ids_param}
	ORDER BY ctime DESC
	LIMIT ?"
);
$albums_pictures_query->bind_param('i', $limit_param);
$albums_pictures_query->execute();
$result = $albums_pictures_query->get_result();

// Build pictures' JSON
include 'picture-builder.php';

// Close the connection
$db_connection->close();
$result->free_result();

// Print the results
echo json_encode($output);

// EOF
