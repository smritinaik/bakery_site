<?php
session_start();
include("dbcon.php");

if(!isset($_SESSION['admin']))
{
    header("Location: admin.php");
    exit();
}

/* DELETE USER */
if(isset($_GET['deleteUser']))
{
    $id = $_GET['deleteUser'];
    mysqli_query($conn,"DELETE FROM users WHERE id=$id");
    header("Location: adminDashboard.php");
    exit();
}

/* DELETE ORDER */
if(isset($_GET['deleteOrder']))
{
    $id = $_GET['deleteOrder'];
    mysqli_query($conn,"DELETE FROM userOrder WHERE id=$id");
    header("Location: adminDashboard.php");
    exit();
}

/* FETCH USERS */
$userQuery = "SELECT * FROM users";
$userResult = mysqli_query($conn,$userQuery);

/* FETCH ORDERS */
$orderQuery = "SELECT * FROM userOrder";
$orderResult = mysqli_query($conn,$orderQuery);

?>

<!DOCTYPE html>
<html>

<head>

<title>Admin Dashboard</title>

<style>

body{
font-family:Arial;
background:#f5ebe0;
padding:40px;
}

h1{
text-align:center;
color:#6b3e26;
}

h2{
margin-top:40px;
}

table{
width:100%;
border-collapse:collapse;
margin-top:20px;
background:white;
}

th,td{
padding:12px;
border:1px solid #ddd;
text-align:center;
}

th{
background:#8b3a2e;
color:white;
}

button{
padding:8px 15px;
background:#8b3a2e;
color:white;
border:none;
border-radius:5px;
cursor:pointer;
}

button:hover{
background:#6b2d23;
}

.logout{
float:right;
margin-bottom:20px;
}

</style>

</head>

<body>

<h1>Admin Dashboard</h1>

<div class="logout">
<a href="adminLogout.php">
<button>Logout</button>
</a>
</div>

<!-- USERS TABLE -->

<h2>Registered Users</h2>

<table>

<tr>
<th>ID</th>
<th>Username</th>
<th>Password</th>
<th>Login Time</th>
<th>Action</th>
</tr>

<?php
while($row=mysqli_fetch_assoc($userResult))
{
?>

<tr>

<td><?php echo $row['id']; ?></td>
<td><?php echo $row['username']; ?></td>
<td><?php echo $row['password']; ?></td>
<td><?php echo $row['login_time']; ?></td>

<td>
<a href="adminDashboard.php?deleteUser=<?php echo $row['id']; ?>"
onclick="return confirm('Are you sure you want to delete this user?');">
<button>Delete</button>
</a>
</td>

</tr>

<?php
}
?>

</table>


<!-- ORDERS TABLE -->

<h2>User Orders</h2>

<table>

<tr>
<th>ID</th>
<th>Customer Name</th>
<th>Cake Type</th>
<th>Quantity</th>
<th>Phone</th>
<th>Address</th>
<th>Order Time</th>
<th>Action</th>
</tr>

<?php
while($row=mysqli_fetch_assoc($orderResult))
{
?>

<tr>

<td><?php echo $row['id']; ?></td>
<td><?php echo $row['customer_name']; ?></td>
<td><?php echo $row['cake_type']; ?></td>
<td><?php echo $row['quantity']; ?></td>
<td><?php echo $row['phone']; ?></td>
<td><?php echo $row['address']; ?></td>
<td><?php echo $row['order_time']; ?></td>

<td>
<a href="adminDashboard.php?deleteOrder=<?php echo $row['id']; ?>"
onclick="return confirm('Are you sure you want to delete this order?');">
<button>Delete</button>
</a>
</td>

</tr>

<?php
}
?>

</table>

</body>
</html>