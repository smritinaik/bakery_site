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


/* Delete User */

if(isset($_GET['deleteUser']))
{
$id = $_GET['deleteUser'];
mysqli_query($conn,"DELETE FROM users WHERE id=$id");
header("Location: adminDashboard.php");
}

/* Delete Order */

if(isset($_GET['deleteOrder']))
{
$id = $_GET['deleteOrder'];
mysqli_query($conn,"DELETE FROM userOrder WHERE id=$id");
header("Location: adminDashboard.php");
}

?>