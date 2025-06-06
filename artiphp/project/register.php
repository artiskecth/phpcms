<?php
echo "<pre>";
print_r($_REQUEST);
echo "</pre>";
$servername = "localhost";
$usrname = "root";
$password = "root";
$dbname = "register";
$conn = mysqli_connect($servername, $usrname, $password,$dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully<br>"; 
$db_con = mysqli_connect($servername, $usrname, $password);


if (!$db_con) {
    die("Connection failed: " . mysqli_connect_error());
}


$dbs = "CREATE DATABASE IF NOT EXISTS register";
if (mysqli_query($db_con, $dbs)) {
    echo "Database created or already exists.<br>";
} else {
    die("Error creating database: " . mysqli_error($db_con));
}


mysqli_select_db($db_con, "register");


$tb = "CREATE TABLE IF NOT EXISTS reg (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255),
    cpassword VARCHAR(255)
)";

if (mysqli_query($db_con, $tb)) {
    echo "Table 'reg' created successfully.";
} else {
    echo "Error creating table: " . mysqli_error($db_con);
}


if (isset($_REQUEST['submit'])) {

   
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $cpassword = $_REQUEST['cpassword'];

    if ($password === $cpassword) {

      $hashedPassword = md5($password);
      $emailCheck = "SELECT * FROM reg WHERE email = '$email'";
      $nameCheck = "SELECT * FROM reg WHERE name = '$name'";
      $emailresult = mysqli_query($db_con, $emailCheck);
      $nameResult = mysqli_query($db_con, $nameCheck);

      if (mysqli_num_rows($emailresult) > 0) {
          echo "Email already registered.";
      } elseif (mysqli_num_rows($nameResult) > 0) {
          echo "Name already registered.";
      } else {
          $sql = "INSERT INTO reg (name, email, password, cpassword) VALUES ('$name', '$email', '$hashedPassword', '$cpassword')";

          if (mysqli_query($db_con, $sql)) {
              echo "New record created successfully";
          } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($db_con);
          }
      }
  } else {
      echo "Passwords do not match.";
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
    body{
  margin: 0;
  padding: 0;
  font-family: Roboto;
  background-repeat: no-repeat;
  background-size: cover;
  background: linear-gradient(120deg, #007bff, #d0314c);
  height: 100vh;
  overflow: hidden;
}

.center{
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 29vw;
  background: white;
  border-radius: 10px;
}

.center h1{
  text-align: center;
  padding: 0 0 20px 0;
  border-bottom: 1px solid silver;
}

.center form{
  padding: 0 40px;
  box-sizing: border-box;
}

form .txt_field{
  position: relative;
  border-bottom: 2px solid #adadad;
  margin: 30px 0;
}

.txt_field input{
  width: 100%;
  padding: 0 5px;
  height: 40px;
  font-size: 16px;
  border: none;
  background: none;
  outline: none;
}

.txt_field label{
  position: absolute;
  top: 50%;
  left: 5px;
  color: #adadad;
  transform: translateY(-50%);
  font-size: 16px;
  pointer-events: none;
}

.txt_field span::before{
  content: '';
  position: absolute;
  top: 40px;
  left: 0;
  width: 0px;
  height: 2px;
  background: #2691d9;
  transition: .5s;
}

.txt_field input:focus ~ label,
.txt_field input:valid ~ label{
  top: -5px;
  color: #2691d9;
}

.txt_field input:focus ~ span::before,
.txt_field input:Valid ~ span::before{
  width: 100%;
}

.pass{
  margin: -5px 0 20px 5px;
  color: #a6a6a6;
  cursor: pointer;
}

.pass:hover{
  text-decoration: underline;
}

input[type="Submit"]{
  width: 100%;
  height: 50px;
  border: 1px solid;
  border-radius: 25px;
  font-size: 18px;
  font-weight: 700;
  cursor: pointer;

}

input[type="Submit"]:hover{
  background: #2691d9;
  color: #e9f4fb;
  transition: .5s;
}

.signup_link{
  margin: 30px 0;
  text-align: center;
  font-size: 16px;
  color: #666666;
}

.signup_link a{
  color: #2691d9;
  text-decoration: none;
}

.signup_link a:hover{
  text-decoration: underline;
}

.HomeAbout{
  width: 100vw;
  height: 25vh;
}
</style>
<body>
<div class="container">
    <div class="center">
        <h1>Register</h1>
        <form method="POST" action="">
            <div class="txt_field">
                <input type="text" name="name" required>
                <span></span>
                <label>name</label>
            </div>
            <div class="txt_field">
                <input type="email" name="email" required>
                <span></span>
                <label>Email</label>
            </div>
            <div class="txt_field">
                <input type="password" name="password" required>
                <span></span>
                <label>Password</label>
            </div>
            <div class="txt_field">
                <input type="password" name="cpassword" required>
                <span></span>
                <label>Confirm Password</label>
            </div>
            <input name="submit" type="Submit" value="Sign Up">
            <div class="signup_link">
                Have an Account ? <a href="#">Login Here</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>