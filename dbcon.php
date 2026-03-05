<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "bakery_db";   // change this if your database name is different

$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

?>