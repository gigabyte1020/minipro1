<!-- hOST UPLOADING HOTEL DETAILS -->
<script>
 if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}
</script>
<?php
require 'db_connection.php';

if(isset($_POST['upload']) )
{
	$filename = $_FILES["uploadfile"]["name"];
	$tempname = $_FILES["uploadfile"]["tmp_name"];
	$folder = "./image/" . $filename;



$hstid = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['hstid']));
$rentname = mysqli_real_escape_string($db_connection,  htmlspecialchars($_POST['rentname']));
$rentsumm = mysqli_real_escape_string($db_connection,  htmlspecialchars($_POST['rentsumm']));
$rentdet = mysqli_real_escape_string($db_connection,  htmlspecialchars($_POST['rentdet']));
$rentpr = mysqli_real_escape_string($db_connection,  htmlspecialchars($_POST['rentpr']));
$rentrul = mysqli_real_escape_string($db_connection,  htmlspecialchars($_POST['rentrul']));

$sql = "INSERT INTO `rent`(`rent_hostid`, `rent_name`, `rent_img`, `rent_detail`, `rent_price`, `rent_summary`, `rent_rules`)  VALUES ('$hstid','$rentname','$filename','$rentdet','$rentpr','$rentsumm','$rentrul')";
//echo "sqk is". $sql;
move_uploaded_file($tempname, $folder);
if(mysqli_query($db_connection, $sql)){
    echo "Records inserted successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($db_connection);
}

}
?>
<html>
    <body>
        <form action="" method='post' enctype="multipart/form-data">
            
        <label for="name"><b>Host ID</b></label>
        <input type="text" placeholder="Enter name" name="hstid" required><br>
            
        <label for="name"><b>Name of your Place</b></label>
        <input type="text" placeholder="Enter name" name="rentname" required><br>

            
        <label for="name"><b>Upload Image</b></label>
        <input type="file" name="uploadfile" value=""> <br>
        
        <label for="name"><b>Enter a one sentence summary about your place</b></label>
        <input type="text" placeholder="Enter data" name="rentsumm" ><br>
        
        <label for="name"><b>Enter some details about your place</b></label>
        <input type="textarea" placeholder="Enter data" name="rentdet"><br>
        
        <label for="name"><b>Enter your price per night</b></label>
        <input type="number" placeholder="Enter data" name="rentpr"><br>
        
        <label for="name"><b>Enter some rules for your place</b></label>
        <input type="textarea" placeholder="Enter data" name="rentrul"><br>
            
<button type="submit" name="upload">Sign Up</button>

        </form>
    </body>
</html>
