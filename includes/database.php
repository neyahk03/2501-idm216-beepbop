<?php
$db_server = 'localhost';
$db_username = 'root';
$db_password = 'root';
$db_name = 'idm216';

// $db_server = 'localhost';
// $db_username = 'yl3434';
// $db_password = 'V/j9wEa9r67EBhxo';
// $db_name = 'yl3434_db';

// $db_server = getenv('DB_SERVER');
// $db_username = getenv('DB_USERNAME');
// $db_password = getenv('DB_PASSWORD');
// $db_name = getenv('DB_NAME');

// Establish a connection to the database
$connection = new mysqli($db_server, $db_username, $db_password, $db_name);

// Check for connection errors
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// echo "Database connected successfully!";
?>