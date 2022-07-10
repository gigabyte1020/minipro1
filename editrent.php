<html>

<head>



<style>

table

{

border-style:solid;

border-width:2px;

border-color:pink;

}

</style>

</head>

<body bgcolor="#EEFDEF">

<?php

require 'db_connection.php';
 

$result = mysqli_query($db_connection,"SELECT * FROM rent");


	
	
	
	
	
	
echo "<table border='1'>

<tr>

<th>rent_hostid	</th>

<th>rent_name</th>

<th>rent_img</th>

<th>rent_detail</th>

<th>rent_price</th>

<th>rent_summary</th>

<th>rent_rules</th>

</tr>";

 

while($row = mysqli_fetch_array($result))

  {
//$images_field= $row['rent_img'];
//$image_show= "/images/$images_field";
  echo "<tr>";

  echo "<td>" . $row['rent_hostid'] . "</td>";

  echo "<td>" . $row['rent_name'] . "</td>";
?>
<td><img src="./image/<?php echo $row['rent_img'] ?>"></td>
    
    <?php
//    echo "<div align=center><img src=". $image_show."></div>";
  echo "<td>" . $row['rent_detail'] . "</td>";
  echo "<td>" . $row['rent_price'] . "</td>";
  echo "<td>" . $row['rent_summary'] . "</td>";
  echo "<td>" . $row['rent_rules'] . "</td>";

  echo "</tr>";

  }

echo "</table>";

 

?>

</body>

</html>