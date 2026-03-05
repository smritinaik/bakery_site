<?php
session_start();

$error = "";

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hardcoded admin credentials
    $admin_user = "admin";
    $admin_pass = "12345";

    if($username == $admin_user && $password == $admin_pass)
    {
        $_SESSION['admin'] = $username;
        header("Location: adminDashboard.php");
        exit();
    }
    else
    {
        $error = "Invalid Admin Username or Password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | BAKERS Bakery</title>
    <style>
        :root {
            --primary: #8b3a2e;
            --bg: #faf7f2;
            --text: #2d2424;
            --white: #ffffff;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg);
            /* Perfect Centering */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: var(--text);
        }

        .login-container {
            background: var(--white);
            width: 100%;
            max-width: 400px;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            text-align: center;
        }

        .login-container h2 {
            color: var(--primary);
            font-size: 24px;
            margin-bottom: 10px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .login-container p.subtitle {
            font-size: 14px;
            color: #888;
            margin-bottom: 30px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        input {
            padding: 15px;
            border-radius: 10px;
            border: 1px solid #ddd;
            background-color: #fdfdfd;
            font-size: 16px;
            outline: none;
            transition: 0.3s;
        }

        input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(139, 58, 46, 0.1);
        }

        button {
            padding: 15px;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }

        button:hover {
            background-color: #6b2e25;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(139, 58, 46, 0.2);
        }

        .error-message {
            color: #d63031;
            background: #fff0f0;
            padding: 10px;
            border-radius: 8px;
            font-size: 14px;
            margin-top: 20px;
            border: 1px solid #ff7675;
        }

        .back-home {
            margin-top: 25px;
            display: inline-block;
            text-decoration: none;
            color: #888;
            font-size: 13px;
            transition: 0.3s;
        }

        .back-home:hover {
            color: var(--primary);
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>BAKERS Admin</h2>
        <p class="subtitle">Please enter your credentials to access the dashboard.</p>

        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Sign In</button>
        </form>

        <?php if($error != ""): ?>
            <div class="error-message">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

    </div>

</body>
</html>