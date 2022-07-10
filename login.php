<?php
session_start();
require 'db_connection.php';
if(isset($_POST['user_email']) && isset($_POST['user_password'])){

// CHECK IF FIELDS ARE NOT EMPTY
if(!empty(trim($_POST['user_email'])) && !empty(trim($_POST['user_password']))){

// Escape special characters.
$user_email = mysqli_real_escape_string($db_connection, htmlspecialchars(trim($_POST['user_email'])));

$user_role = mysqli_real_escape_string($db_connection, htmlspecialchars(trim($_POST['user_role'])));
$query = mysqli_query($db_connection, "SELECT * FROM `users` WHERE user_email = '$user_email'");

if(mysqli_num_rows($query) > 0){

$row = mysqli_fetch_assoc($query);
$user_db_pass = $row['user_password'];

// VERIFY PASSWORD
$check_password = password_verify($_POST['user_password'], $user_db_pass);

if($check_password === TRUE){

session_regenerate_id(true);

$_SESSION['user_email'] = $user_email;  

$_SESSION['user_role'] = $row['user_role'];  
header('Location: succ.php');
exit;

}
else{
// INCORRECT PASSWORD
$error_message = "Incorrect Email Address or Password.";

}

}
else{
// EMAIL NOT REGISTERED
$error_message = "Incorrect Email Address or Password.";
}

}
else{

// IF FIELDS ARE EMPTY
$error_message = "Please fill in all the required fields.";
}

}
// IF USER LOGGED IN
//if(isset($_SESSION['user_email'])){
//header('Location: succ.php');
//exit;
//}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Footmarkz.com</title>
<link rel="stylesheet" href="style.css" media="all" type="text/css">
</head>

<body>

<form action="" method="post">
<h2>User Login</h2>

<div class="container">
<label for="email"><b>Email</b></label>
<input type="email" placeholder="Enter email" id="email" name="user_email" required>

<label for="password"><b>Password</b></label>
<input type="password" placeholder="Enter password" id="password" name="user_password" required>

<button type="submit">Login</button>
</div>

<div class="container" style="background-color:#f1f1f1">
<a href="signup.php"><button type="button" class="Regbtn">Create an account</button></a>
</div>
</form>
<a href="logout.php">Logout</a>
</body></html>