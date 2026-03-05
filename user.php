<?php
include("dbcon.php");

$message = "";

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (username, password) 
            VALUES ('$username', '$password')";

    $result = mysqli_query($conn, $sql);

    if($result)
    {
        header("Location: homepgOrderFrom.php");
        exit();
    }
    else
    {
        $message = "Error inserting data!";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
<title>User Login</title>
</head>

<body>

<h2>User Login</h2>

<form method="POST">

<input type="text" name="username" placeholder="Enter Username" required>
<br><br>

<input type="password" name="password" placeholder="Enter Password" required>
<br><br>

<button type="submit" name="login">Login</button>

</form>

<p style="color:red;">
<?php echo $message; ?>
</p>

</body>

</html>