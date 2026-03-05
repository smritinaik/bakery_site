<?php
session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
</head>

<body>

<h1>Welcome Admin</h1>

<a href="adminLogout.php">Logout</a>

</body>
</html>