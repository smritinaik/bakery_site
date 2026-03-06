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

/* ADD USER */
if(isset($_POST['addUser']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    mysqli_query($conn,"INSERT INTO users (username,password) VALUES ('$username','$password')");
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
$userCount = mysqli_num_rows($userResult);

/* FETCH ORDERS */
$orderQuery = "SELECT * FROM userOrder";
$orderResult = mysqli_query($conn,$orderQuery);
$orderCount = mysqli_num_rows($orderResult);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<title>Admin Portal | BAKERS Bakery</title>

<style>
:root {
--primary:#8b3a2e;
--sidebar-bg:#2d2424;
--main-bg:#f3e1cf;
--text-dark:#333;
--white:#ffffff;
}

body{
font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
background:var(--main-bg);
margin:0;
display:flex;
color:var(--text-dark);
}

.sidebar{
width:260px;
background:var(--sidebar-bg);
height:100vh;
position:fixed;
color:white;
padding:30px 20px;
}

.sidebar h2{
color:var(--white);
font-size:20px;
letter-spacing:2px;
border-bottom:1px solid #444;
padding-bottom:20px;
margin-bottom:30px;
}

.sidebar a{
display:block;
color:#bbb;
text-decoration:none;
padding:12px 15px;
transition:0.3s;
font-size:13px;
text-transform:uppercase;
letter-spacing:1px;
border-radius:8px;
margin-bottom:5px;
cursor:pointer;
}

.sidebar a:hover,.sidebar a.active{
color:white;
background:rgba(255,255,255,0.1);
}

.logout-link{
position:absolute;
bottom:40px;
color:#ff7675 !important;
width:220px;
}

.main-content{
margin-left:300px;
padding:40px;
width:calc(100% - 340px);
}

.stats-grid{
display:grid;
grid-template-columns:repeat(2,1fr);
gap:20px;
margin-bottom:40px;
}

.stat-card{
background:white;
padding:20px;
border-radius:15px;
box-shadow:0 4px 15px rgba(0,0,0,0.05);
border-left:5px solid var(--primary);
}

.stat-card h3{margin:0;font-size:14px;color:#888;text-transform:uppercase;}
.stat-card p{margin:10px 0 0;font-size:28px;font-weight:bold;color:var(--primary);}

.table-container{
background:var(--white);
border-radius:15px;
padding:25px;
box-shadow:0 4px 20px rgba(0,0,0,0.05);
margin-bottom:40px;
display:block;
}

h2{font-size:18px;color:var(--primary);text-transform:uppercase;margin-top:0;}

table{width:100%;border-collapse:collapse;}

th{
text-align:left;
padding:15px;
background:#f8f9fa;
font-size:12px;
color:#888;
border-bottom:2px solid #eee;
}

td{
padding:15px;
border-bottom:1px solid #f1f1f1;
font-size:14px;
}

.btn-delete{
background:#fff0f0;
color:#d63031;
border:1px solid #ff7675;
padding:6px 12px;
border-radius:6px;
cursor:pointer;
transition:0.3s;
}

.btn-delete:hover{background:#d63031;color:white;}

.badge{
padding:4px 10px;
border-radius:20px;
font-size:11px;
background:#e3d5ca;
color:#6b3e26;
}

/* add user icon */
.users-title{
display:flex;
justify-content:space-between;
align-items:center;
}

.add-icon-btn{
background:#2e8b57;
color:white;
border:none;
padding:8px 12px;
border-radius:6px;
cursor:pointer;
font-size:16px;
}

.add-icon-btn:hover{
background:#246b45;
}
</style>
</head>

<body>

<div class="sidebar">
<h2>BAKERS ADMIN</h2>
<a onclick="showSection('all')" id="link-all" class="active">Overview</a>
<a onclick="showSection('users')" id="link-users">Registered Users</a>
<a onclick="showSection('orders')" id="link-orders">Customer Orders</a>
<a href="adminLogout.php" class="logout-link">Logout</a>
</div>

<div class="main-content">

<header style="margin-bottom:30px;">
<h1>Dashboard</h1>
</header>

<div class="stats-grid">

<div class="stat-card">
<h3>Total Members</h3>
<p><?php echo $userCount; ?></p>
</div>

<div class="stat-card">
<h3>Total Orders</h3>
<p><?php echo $orderCount; ?></p>
</div>

</div>

<!-- USERS -->

<div class="table-container" id="section-users">

<h2 class="users-title">
Registered Users 
<button class="add-icon-btn" onclick="openAddUser()" title="Add User">
<i class="fa-solid fa-user-plus"></i>
</button>
</h2>

<table>

<thead>
<tr>
<th>ID</th>
<th>Username</th>
<th>Login Time</th>
<th>Action</th>
</tr>
</thead>

<tbody>

<?php while($row=mysqli_fetch_assoc($userResult)) { ?>

<tr>

<td>#<?php echo $row['id']; ?></td>
<td><strong><?php echo $row['username']; ?></strong></td>
<td><?php echo $row['login_time']; ?></td>

<td>


<a href="adminDashboard.php?deleteUser=<?php echo $row['id']; ?>" onclick="return confirm('Delete user?');">
<button class="btn-delete" title="Delete">
<i class="fa-solid fa-trash"></i>
</button></a>

</td>

</tr>

<?php } ?>

</tbody>
</table>

</div>

<!-- ORDERS -->

<div class="table-container" id="section-orders">

<h2>User Orders</h2>

<table>

<thead>
<tr>
<th>Order</th>
<th>Customer</th>
<th>Cake</th>
<th>Qty</th>
<th>Address</th>
<th>Action</th>
</tr>
</thead>

<tbody>

<?php while($row=mysqli_fetch_assoc($orderResult)) { ?>

<tr>

<td>#<?php echo $row['id']; ?></td>
<td><strong><?php echo $row['customer_name']; ?></strong></td>
<td><span class="badge"><?php echo $row['cake_type']; ?></span></td>
<td>x<?php echo $row['quantity']; ?></td>
<td><small><?php echo $row['address']; ?></small></td>

<td>

<a href="adminDashboard.php?deleteOrder=<?php echo $row['id']; ?>" onclick="return confirm('Complete order?');">
<button class="btn-delete">Complete</button>
</a>

</td>

</tr>

<?php } ?>

</tbody>
</table>

</div>

</div>

<!-- ADD USER MODAL -->

<div id="addUserModal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.4);">

<div style="background:white;padding:30px;width:300px;margin:150px auto;border-radius:10px;">

<h3>Add New User</h3>

<form method="POST">

<input type="text" name="username" placeholder="Username" required style="width:100%;padding:8px;margin-bottom:10px;">

<input type="text" name="password" placeholder="Password" required style="width:100%;padding:8px;margin-bottom:10px;">

<button type="submit" name="addUser">Create User</button>

<button type="button" onclick="closeAddUser()">Cancel</button>

</form>

</div>
</div>

<script>

function showSection(sectionId){

const userSection=document.getElementById('section-users');
const orderSection=document.getElementById('section-orders');

const links=document.querySelectorAll('.sidebar a');
links.forEach(l=>l.classList.remove('active'));

if(sectionId==='users'){
userSection.style.display='block';
orderSection.style.display='none';
document.getElementById('link-users').classList.add('active');
}

else if(sectionId==='orders'){
userSection.style.display='none';
orderSection.style.display='block';
document.getElementById('link-orders').classList.add('active');
}

else{
userSection.style.display='block';
orderSection.style.display='block';
document.getElementById('link-all').classList.add('active');
}

}

function openAddUser(){
document.getElementById("addUserModal").style.display="block";
}

function closeAddUser(){
document.getElementById("addUserModal").style.display="none";
}

</script>

</body>
</html>