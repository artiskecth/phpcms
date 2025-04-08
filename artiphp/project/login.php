<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "root";
$dbname="register";

$conn = mysqli_connect($servername, $username, $password,$dbname);

if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    if ($password) {
        
       
        $hashedPassword = md5($password);
       echo $hashedPassword;
// Verify the entered password against the hashed password

    $sql = "SELECT * FROM `reg` WHERE email = '$email' AND password = '$hashedPassword'"; 
    $result = mysqli_query($conn, $sql);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            echo "('Login successful!');";
            $_SESSION['email'] = $email; 
            //header('Location: register.php');
          
        } else {
            echo "('Invalid email or password.');";
        }
    } else {
        echo "('Error: " . mysqli_error($conn) . "');";
    } 
}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body {
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0;
        background: #009579;
    }

    .container {
        width: 400px;
        height: 400px;
        background-color: #ffffff;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 10px;
    }

    .inputbox {
        margin: 10px 0;
    }

    input {
        height: 35px;
        width: 250px;
        padding: 5px;
        border: 3px solid;
        border-radius: 5px;
        background-color: #f2f2f2;
        border-color:#009579;
    }
    button{
        width: 265px;
    height: 48px;
    background: #009579;
    color: #fff;
    border: none;
    padding: 19px;
    text-align: center;
    display: flex;
    justify-content: center;
    border-radius: 5px;
}
</style>

<body>
    <div class="container">
        <div class="inputdiv">
            <form method="POST">
                
              
                <div class="inputbox">
                    <input type="text" placeholder="email"  name="email">
                </div>
                <div class="inputbox">
                    <input type="password" placeholder="password" id="password" name="password">
                </div>
                
                <button type="submit"   id="button" name="submit">LOGIN</button>
                
    </div>
</body>

</html>
