<?php
include("dbcon.php");
$message="";
if(isset($_POST['order'])) {
    $name=$_POST['name'];
    $cake=$_POST['cake'];
    $qty=$_POST['qty'];
    $phone=$_POST['phone'];
    $address=$_POST['address'];

    $sql="INSERT INTO userOrder(customer_name,cake_type,quantity,phone,address)
    VALUES('$name','$cake','$qty','$phone','$address')";
    $result=mysqli_query($conn,$sql);

    if($result) { $message="Order placed successfully!"; }
    else { $message="Order failed!"; }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BAKERS Bakery | Artisanal Sweets</title>
    <style>
        :root {
            --primary: #8b3a2e;
            --bg: #ebe4d9;
            --card-bg: #ffffff;
            --text: #2d2424;
            --accent: #e3d5ca;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.6;
        }

       /* Refined Navbar */
nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 8%;
    background: rgb(219, 203, 177); /* Semi-transparent */
    backdrop-filter: blur(10px); /* Modern Glassmorphism effect */
    position: sticky;
    top: 0;
    z-index: 1000;
    border-bottom: 1px solid rgba(139, 58, 46, 0.1);
    transition: all 0.3s ease;
    margin : 25px;
    border-radius: 60px;
}

nav h2 {
    color: var(--primary);
    font-family: "serif";
    font-size: 24px;
    letter-spacing: 3px;
    margin: 0;
    font-weight: 800;
    text-transform: uppercase;
}

nav ul {
    list-style: none;
    display: flex;
    gap: 35px;
    margin: 0;
    align-items: center;
}

nav a {
    text-decoration: none;
    color: var(--text);
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    position: relative;
    padding: 5px 0;
    transition: 0.3s;
}

/* Subtle Hover Animation */
nav a::after {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    bottom: 0;
    left: 0;
    background-color: var(--primary);
    transition: width 0.3s ease;
}

nav a:hover {
    color: var(--primary);
}

nav a:hover::after {
    width: 100%;
}

/* Special Button Style for the Order Link */
nav li:last-child a {
    background: var(--primary);
    color: white;
    padding: 10px 20px;
    border-radius: 50px;
    transition: 0.3s ease;
}

nav li:last-child a:hover {
    background: #6b2e25;
    box-shadow: 0 4px 15px rgba(139, 58, 46, 0.3);
}

nav li:last-child a::after {
    display: none; /* Remove underline for the button */
}

        /* Hero Section */
        .hero {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 80px 8%;
            min-height: 60vh;
        }

        .hero-text { width: 45%; }

        .hero-text h1 {
            font-size: clamp(40px, 5vw, 64px);
            line-height: 1.1;
            margin-bottom: 20px;
            color: var(--text);
        }

        .hero-text p {
            font-size: 18px;
            color: #666;
            margin-bottom: 30px;
        }

        .cta-btn {
            padding: 15px 35px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 50px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .cta-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(139, 58, 46, 0.2);
        }

        .hero img {
            width: 45%;
            height: 500px;
            object-fit: cover;
            border-radius: 30px;
            /* box-shadow: 20px 20px 0px var(--accent); */
        }

        /* Menu Section */
        .menu { padding: 100px 8%; text-align: center; }

        .menu h2 {
            font-size: 32px;
            margin-bottom: 50px;
            position: relative;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 40px;
        }

        .card {
            background: #e3d5ca;
            padding: 20px;
            border-radius: 20px;
            transition: 0.4s;
            border: 1px solid #eee;
        }

        .card:hover {
            transform: translateY(-28px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.05);
        }

        .card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 15px;
        }

        .card h3 { margin: 20px 0 10px; font-size: 22px; }

        .card p {
            color: var(--primary);
            font-weight: bold;
            font-size: 18px;
        }

        /* Order Section */
        .order-section {
            background: var(--accent);
            padding: 100px 8%;
            border-radius: 50px 50px 0 0;
        }

        .order-container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 40px;
            border-radius: 30px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.05);
        }

        .order-section h2 { text-align: center; margin-bottom: 30px; }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        input, select, textarea {
            padding: 15px;
            border-radius: 12px;
            border: 1px solid #ddd;
            background: #fdfdfd;
            font-size: 15px;
            outline: none;
        }

        input:focus { border-color: var(--primary); }

        button[name="order"] {
            padding: 15px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: bold;
            cursor: pointer;
            font-size: 16px;
            transition: 0.3s;
        }

        button[name="order"]:hover { opacity: 0.9; }

        .success {
            color: #2d6a4f;
            background: #d8f3dc;
            padding: 10px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .hero { flex-direction: column; text-align: center; padding-top: 40px; }
            .hero-text { width: 100%; margin-bottom: 50px; }
            .hero img { width: 100%; height: 300px; }
            nav ul { display: none; }
        }


        /* Full Menu Section */
.full-menu {
    padding: 100px 8%;
    background-color: #ebe4d9;
}

.menu-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px 80px;
    margin-top: 50px;
}

.menu-category-title {
    font-family: serif;
    font-size: 28px;
    color: var(--primary);
    margin-bottom: 30px;
    text-align: center;
    grid-column: 1 / -1;
    letter-spacing: 2px;
}

.menu-item {
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    padding-bottom: 10px;
    border-bottom: 1px dotted #ccc;
    transition: 0.3s;
}

.menu-item:hover {
    border-bottom: 1px solid #6b2e25;
    transform: translateX(15px);
}

.item-info h4 {
    margin: 0;
    font-size: 18px;
    color: var(--text);
    font-weight: 600;
}

.item-info p {
    margin: 5px 0 0;
    font-size: 14px;
    color: #888;
    font-style: italic;
}

.item-price {
    font-weight: bold;
    color: var(--primary);
    font-size: 18px;
}

@media (max-width: 768px) {
    .menu-grid {
        grid-template-columns: 1fr;
    }
}
    </style>
</head>
<body>

<nav>
    <div class="logo">
        <h2>BAKERS</h2>
    </div>
    
    <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#menu">Menu</a></li>
        <li><a href="#order">Place Order</a></li>
    </ul>
</nav>

<section class="hero">
    <div class="hero-text">
        <h1 style="color: #42221d">Sweet Moments <br>Start Here</h1>
        <p>Experience the art of artisanal baking. Every cake is handcrafted with premium ingredients and a dash of love.</p>
        <button class="cta-btn">Explore Menu</button>
    </div>
    <img src="img/cake.png" alt="Featured Dessert">
</section>

<section class="menu" id="menu">
    <h3 class="menu-category-title">Our Best Sellers</h3>    <div class="cards">
        <div class="card">
            <img src="img/velvet.jpg" alt="Strawberry">
            <h3>Red Velvet Cake</h3>
            <p>Rs.470/-</p>
        </div>
        <div class="card">
            <img src="img/blueberry.jpg" alt="Chocolate">
            <h3>Blue Berry cake</h3>
            <p>Rs.500/-</p>
        </div>
        <div class="card">
            <img src="img/forest.jpg" alt="Vanilla">
            <h3> Black forest</h3>
            <p>Rs.750/-</p>
        </div>
    </div>
</section>

<!-- MENU -->
<section class="full-menu" id="full-menu">
    <h3 class="menu-category-title">Explore Our Full Menu</h3>
    
    <div class="menu-grid">
        <div class="menu-item">
            <div class="item-info">
                <h4>Midnight Chocolate Ganache</h4>
                <p>Rich dark chocolate with velvet frosting</p>
            </div>
            <span class="item-price">$12.00</span>
        </div>

        <div class="menu-item">
            <div class="item-info">
                <h4>Summer Strawberry Cream</h4>
                <p>Fresh organic strawberries & whipped cream</p>
            </div>
            <span class="item-price">$15.00</span>
        </div>

        <div class="menu-item">
            <div class="item-info">
                <h4>Classic Madagascar Vanilla</h4>
                <p>Authentic bean paste and buttery sponge</p>
            </div>
            <span class="item-price">$10.00</span>
        </div>

        <div class="menu-item">
            <div class="item-info">
                <h4>Red Velvet Royale</h4>
                <p>Traditional cocoa base with cream cheese swirl</p>
            </div>
            <span class="item-price">$14.00</span>
        </div>

        <div class="menu-item">
            <div class="item-info">
                <h4>Salted Caramel Drizzle</h4>
                <p>Sweet & salty perfection with gold leaf</p>
            </div>
            <span class="item-price">$13.00</span>
        </div>

        <div class="menu-item">
            <div class="item-info">
                <h4>Lemon Zest Chiffon</h4>
                <p>Light, airy, and refreshingly tangy</p>
            </div>
            <span class="item-price">$11.00</span>
        </div>
    </div>
</section>


<section class="order-section" id="order">
    <div class="order-container">
        <h2>Place Your Order</h2>
        <?php if($message != ""): ?>
            <p class="success"><?php echo $message; ?></p>
        <?php endif; ?>
        
        <form method="POST">
            <input type="text" name="name" placeholder="Full Name" required>
            <select name="cake">
                <option disabled selected>Select your cake</option>
                <option>Chocolate Cake</option>
                <option>Strawberry Cake</option>
                <option>Red Valvet Cake</option>
                <option>Custard Pudding</option>
                <option>Brownie</option>
                <option>Vanilla Cake</option>
            </select>
            <input type="number" name="qty" placeholder="How many cakes?" min="1" required>
            <input type="text" name="phone" placeholder="Phone Number" required>
            <textarea name="address" placeholder="Delivery Address" rows="3"></textarea>
            <button type="submit" name="order">Place Order</button>
        </form>
    </div>
</section>


<footer style="
margin-top:40px;
padding:15px;
text-align:center;
font-size:13px;
color:#5e4343;
">
© <?php echo date("Y"); ?> BAKERS Bakery  | Developed and Designed by smriti
</footer>

</body>
</html>