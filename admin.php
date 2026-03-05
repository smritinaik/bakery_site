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
<html>
<head>
<title>Admin Login</title>
</head>

<body>

<h2>Admin Login</h2>

<form method="POST">

<input type="text" name="username" placeholder="Enter Username" required>
<br><br>

<input type="password" name="password" placeholder="Enter Password" required>
<br><br>

<button type="submit" name="login">Login</button>

</form>

<p style="color:red;">
<?php echo $error; ?>
</p>

</body>
</html>