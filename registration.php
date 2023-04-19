<?php

session_start();

$host = "localhost";
$user = "root";
$pwd = "";
$dbname = "eventpro";

$conn = mysqli_connect($host,$user,$pwd,$dbname);
if(!$conn){
    die("Not connected");
}

if(isset($_POST['register'])){

    $email = mysqli_real_escape_string($conn, $_POST['txtemail']);
    $pass = md5($_POST['txtpassword']);
    $cpass = md5($_POST['txtcpassword']);
 
    $select = " SELECT * FROM registration WHERE email = '$email' && password = '$pass' ";
    
    $result = mysqli_query($conn, $select);
 
    if(mysqli_num_rows($result) > 0){
 
       $error[] = 'user already exist!';
 
    }else{
 
       if($pass != $cpass){
          $error[] = 'password not matched!';
       }else{
          $insert = "INSERT INTO registration(email, password, cpassword) VALUES('$email','$pass', '$cpass')";
          mysqli_query($conn, $insert);
          header('location:login.php');
       }
    }
 
 };
 
 
?>
 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Register</title>
</head>
<body>
    <section>
        <div class="login-box">
            <form action="" method="post">
                <h2>Register</h2>
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

                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" name="txtcpassword" required>
                    <label>Confirm Password</label>
                </div>
    
                <!-- <div class="remember-forgot">
                    <label><input type="checkbox">Remember me</label>
                    <a href="#">Forgot Password?</a>
                </div> -->
                <button type="submit" name="register">Register</button>
    
                <div class="register-link">
                    <p>Already have an account? <a href="login.php">Sign in</a></p>
                </div>
    
            </form>
        </div>
        </section>
    
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    
    
</body>
</html>