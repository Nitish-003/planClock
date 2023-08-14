<?php
// Include configuration file
require_once 'config.php';

// Create database connection
$db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($db->connect_error) {
    die("connection failed: ". $db->connect_error);


}

