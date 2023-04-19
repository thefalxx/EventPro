<?php 

session_start();

$host = 'localhost';
$user = 'root';
$pwd  = '';
$dbname = 'eventpro';

$conn = new mysqli($host, $user, $pwd, $dbname);

if ($conn->connect_error) {
    die("Not connected: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {

    $stmt = $conn->prepare("SELECT * FROM registration WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $pass);

    $email = $_POST['txtemail'];
    $pass = md5($_POST['txtpassword']);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['txtemail'] = $email;
        header("location: index.html");
    } else {
        echo "<script> alert('login failed!') </script>";
    }

    $stmt->close();
}

$conn->close();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>EventPro</title>
</head>
<body>
    <section>
    <div class="login-box"> 
        <form action="" method="post">
            <h2>Login</h2>
            <div class="input-box">
                <span class="icon"><ion-icon name="mail"></ion-icon></span>
                <input type="email" name="txtemail" required>
                <label>Email</label>
            </div>

            <div class="input-box">
                <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                <input type="password" name="txtpassword" required>
                <label>Password</label>
            </div>

            <div class="remember-forgot">
                <label><input type="checkbox">Remember me</label>
                <a href="#">Forgot Password?</a>
            </div>
            <button type="submit" name="submit">
                Login
            </button>

            <div class="register-link">
                <p>Don't have an account? <a href="registration.php">Register</a></p>
            </div>

        </form>
    </div>
    </section>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
</html>