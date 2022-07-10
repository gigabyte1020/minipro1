<?php
$db_connection = mysqli_connect("localhost:3306","root","","tt2");
// Check connection
if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>