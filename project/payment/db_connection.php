<?php

$servername = "localhost";
$username = "root"; // Put the MySQL Username
$password = ""; // Put the MySQL Password
$database = "project-309"; // Put the Database Name

// Create connection for integration
$conn_integration = mysqli_connect($servername, $username, $password, $database);

// Check connection for integration
if (!$conn_integration) {
    die("Connection failed: " . mysqli_connect_error());
}

