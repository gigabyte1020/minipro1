<?php
require 'db_connection.php';
if(isset($_POST['username']) && isset($_POST['user_email']) && isset($_POST['user_password'])){

// CHECK IF FIELDS ARE NOT EMPTY
if(!empty(trim($_POST['username'])) && !empty(trim($_POST['user_email'])) && !empty($_POST['user_password'])){

// Escape special characters.
$username = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['username']));
$user_email = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['user_email']));

$role = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['role']));

//IF EMAIL IS VALID
if (filter_var($user_email, FILTER_VALIDATE_EMAIL)) {  

// CHECK IF EMAIL IS ALREADY REGISTERED
$check_email = mysqli_query($db_connection, "SELECT `user_email` FROM `users` WHERE user_email = '$user_email'");

if(mysqli_num_rows($check_email) > 0){    
$error_message = "This Email Address is already registered. Please Try another.";
}
else{
// IF EMAIL IS NOT REGISTERED

$user_hash_password = password_hash($_POST['user_password'], PASSWORD_DEFAULT);

// INSER USER INTO THE DATABASE
$insert_user = mysqli_query($db_connection, "INSERT INTO `users` (username, user_email, user_password,user_role) VALUES ('$username', '$user_email', '$user_hash_password','$role')");

if($insert_user === TRUE){
$success_message = "Thanks! You have successfully signed up.";
}
else{
$error_message = "Oops! something wrong.";
}
}    
}
else {
// IF EMAIL IS INVALID
$error_message = "Invalid email address";
}
}
else{
// IF FIELDS ARE EMPTY
$error_message = "Please fill in all the required fields.";
}
}
?>
 
//<?php 
//session_start();
//require 'db_connection.php';
//// IF USER LOGGED IN
//if(isset($_SESSION['user_email'])){
//header('Location: index.php');
//exit;
//}
//?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign Up - Footmarkz.com</title>
<link rel="stylesheet" href="style.css" media="all" type="text/css">
</head>

<body>

<form action="" method="post">
<h2>Create an account</h2>

<div class="container">
<label for="username"><b>Username</b></label>
<input type="text" placeholder="Enter username" id="username" name="username" required>

<label for="email"><b>Email</b></label>
<input type="email" placeholder="Enter email" id="email" name="user_email" required>

<label for="password"><b>Password</b></label>
<input type="password" placeholder="Enter password" id="password" name="user_password" required>
Employee List :  
<select name="role">  
  <option value="">Select</option>}  
  <option value="guest">Guest</option>  
  <option value="host">Host</option>  
  <option value="hotel">Business Hotel</option>  
</select>   
<button type="submit">Sign Up</button>
</div>
//<?php
//if(isset($success_message)){
//echo '<div class="success_message">'.$success_message.'</div>'; 
//}
//if(isset($error_message)){
//echo '<div class="error_message">'.$error_message.'</div>'; 
//}
//?>
<div class="container" style="background-color:#f1f1f1">
    <a href="login.php"><button type="button" class="Regbtn">Login</button></a><br>
<a href="editrent.php"><button type="button" class="Regbtn">Edit Rent</button></a><br>

</div>
</form>
</body></html>