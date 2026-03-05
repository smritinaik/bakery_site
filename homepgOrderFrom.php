<?php
include("dbcon.php");

$message="";

if(isset($_POST['order']))
{
$name=$_POST['name'];
$cake=$_POST['cake'];
$qty=$_POST['qty'];
$phone=$_POST['phone'];
$address=$_POST['address'];

$sql="INSERT INTO userOrder(customer_name,cake_type,quantity,phone,address)
VALUES('$name','$cake','$qty','$phone','$address')";

$result=mysqli_query($conn,$sql);

if($result)
{
$message="Order placed successfully!";
}
else
{
$message="Order failed!";
}
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Bakery Order</title>

<style>

body{
margin:0;
font-family:Arial;
background:#f5ebe0;
}

/* Navbar */

nav{
display:flex;
justify-content:space-between;
align-items:center;
padding:20px 60px;
background:#f5ebe0;
}

nav h2{
color:#6b3e26;
}

nav ul{
list-style:none;
display:flex;
gap:30px;
}

nav a{
text-decoration:none;
color:black;
font-weight:bold;
}

/* Hero Section */

.hero{
display:flex;
justify-content:space-between;
align-items:center;
padding:60px;
}

.hero-text{
width:50%;
}

.hero-text h1{
font-size:50px;
}

.hero-text button{
padding:12px 25px;
background:#8b3a2e;
color:white;
border:none;
border-radius:20px;
cursor:pointer;
}

.hero img{
width:420px;
border-radius:15px;
}

/* Cake cards */

.menu{
padding:60px;
text-align:center;
}

.cards{
display:flex;
justify-content:center;
gap:30px;
margin-top:40px;
}

.card{
background:white;
padding:15px;
border-radius:15px;
width:250px;
box-shadow:0px 3px 10px rgba(0,0,0,0.1);
}

.card img{
width:100%;
border-radius:10px;
}

.card h3{
margin:10px 0;
}

/* Order form */

.order-section{
background:#e3d5ca;
padding:60px;
margin-top:40px;
}

.order-section h2{
text-align:center;
}

form{
width:400px;
margin:auto;
display:flex;
flex-direction:column;
gap:15px;
}

input,select,textarea{
padding:10px;
border-radius:5px;
border:1px solid gray;
}

button{
padding:12px;
background:#8b3a2e;
color:white;
border:none;
border-radius:8px;
cursor:pointer;
}

.success{
color:green;
text-align:center;
font-weight:bold;
}

</style>

</head>

<body>

<!-- NAVBAR -->

<nav>
<h2>Frem Bakery</h2>

<ul>
<li><a href="#">Home</a></li>
<li><a href="#">Menu</a></li>
<li><a href="#">Order</a></li>
</ul>

</nav>

<!-- HERO -->

<section class="hero">

<div class="hero-text">

<h1>Sweet Moments Start Here</h1>

<p>Delicious cakes and desserts made fresh everyday.</p>

<button>Explore Menu</button>

</div>

<img src="https://images.unsplash.com/photo-1551024601-bec78aea704b">

</section>

<!-- MENU -->

<section class="menu">

<h2>Our Special Cakes</h2>

<div class="cards">

<div class="card">
<img src="https://images.unsplash.com/photo-1578985545062-69928b1d9587">
<h3>Chocolate Cake</h3>
<p>$12</p>
</div>

<div class="card">
<img src="https://images.unsplash.com/photo-1559620192-032c4bc4674e">
<h3>Strawberry Cake</h3>
<p>$15</p>
</div>

<div class="card">
<img src="https://images.unsplash.com/photo-1601979031925-424e53b6caaa">
<h3>Vanilla Cake</h3>
<p>$10</p>
</div>

</div>

</section>



<!-- ORDER FORM -->
<section class="order-section">
<h2>Place Your Order</h2>
<p class="success"><?php echo $message; ?></p>
<form method="POST">
<input type="text" name="name" placeholder="Your Name" required>
<select name="cake">
<option>Chocolate Cake</option>
<option>Strawberry Cake</option>
<option>Vanilla Cake</option>
</select>
<input type="number" name="qty" placeholder="Quantity" required>
<input type="text" name="phone" placeholder="Phone Number" required>
<textarea name="address" placeholder="Delivery Address"></textarea>
<button type="submit" name="order">Place Order</button>
</form>
</section>
<!-- ORDER FORM END-->
</body>
</html>