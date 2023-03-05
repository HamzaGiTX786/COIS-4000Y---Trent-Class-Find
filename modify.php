<?php
include 'includes/library.php';



  
$result_Node = mysqli_query($conn,"SELECT * FROM Node");
$result_Room = mysqli_query($conn,"SELECT * FROM Room");
$result_Building = mysqli_query($conn,"SELECT * FROM Buildings");
$result_Edge = mysqli_query($conn,"SELECT * FROM Edge");
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/master.css"/>
    <script src="https://kit.fontawesome.com/e156dbae2b.js" crossorigin="anonymous"></script>

    <title>Modify</title>
</head>
<body>
	<h2>Nodes</h2>
<?php
if (mysqli_num_rows($result_Node) > 0) {
?>
<table>
	  <tr>
	    <td>ID</td>
		<td>Location</td>
		<td>Name</td>
		<td>Neighbours</td>
        <td>Action</td>
		
	  </tr>
			<?php
			$i=0;
			while($row = mysqli_fetch_array($result_Node)) {
			?>
	  <tr>
<td><?php echo $row["ID"]; ?></td>
		<td><?php echo $row["Location"]; ?></td>
		<td><?php echo $row["Name"]; ?></td>
		<td><?php echo $row["Neighbours"]; ?></td>
		<td><a href="update.php?ID=<?php echo $row["ID"]; ?>">Update</a></td>
      </tr>
			<?php
			$i++;
			}
			?>
</table>
 <?php
}
else
{
    echo "No result found for Nodes";
}
// 
?>
<?php
// maybe set $i to 0???
if (mysqli_num_rows($result_Room) > 0) {
?>
<h2>Room</h2>
<table>
	  <tr>
	    <td>ID</td>
		<td>Building Code</td>
		<td>Name</td>
		<td>Type</td>
		<td>Image</td>
        <td>Action</td>
		
	  </tr>
			<?php
			$i=0;
			while($row = mysqli_fetch_array($result_Room)) {
			?>
	  <tr>
<td><?php echo $row["ID"]; ?></td>
		<td><?php echo $row["Building_code"]; ?></td>
		<td><?php echo $row["Name"]; ?></td>
		<td><?php echo $row["Type"]; ?></td>
		<td><?php echo $row["Image"]; ?></td>
		<td><a href="update.php?ID=<?php echo $row["ID"]; ?>">Update</a></td>
      </tr>
			<?php
			$i++;
			}
			?>
</table>
 <?php
}
else
{
    echo "No result found for Room";
}
// building modify
?>
<?php
// maybe set $i to 0???
if (mysqli_num_rows($result_Building) > 0) {
?>
<h2>Building</h2>
<table>
	  <tr>
	    <td>Code</td>
		<td>Name</td>
		<td>Number of Rooms</td>
		<td>Geo-location</td>
        <td>Action</td>
		
	  </tr>
			<?php
			$i=0;
			while($row = mysqli_fetch_array($result_Building)) {
			?>
	  <tr>
<td><?php echo $row["Code"]; ?></td>
		<td><?php echo $row["Name"]; ?></td>
		<td><?php echo $row["No_of_rooms"]; ?></td>
		<td><?php echo $row["Geo-location"]; ?></td>
		<td><a href="update.php?ID=<?php echo $row["Code"]; ?>">Update</a></td>
      </tr>
			<?php
			$i++;
			}
			?>
</table>
 <?php
}
else
{
    echo "No result found for building";
}
//modify edge 
?>
<?php
// maybe set $i to 0???
if (mysqli_num_rows($result_Edge) > 0) {
?>
<h2>Route</h2>
<table>
	  <tr>
	    <td>ID</td>
		<td>Start Node</td>
		<td>End Node</td>
		<td>Distance</td>
		<td>Images</td>
        <td>Action</td>
		
	  </tr>
			<?php
			$i=0;
			while($row = mysqli_fetch_array($result_Edge)) {
			?>
	  <tr>
<td><?php echo $row["ID"]; ?></td>
		<td><?php echo $row["Start_Node"]; ?></td>
		<td><?php echo $row["End_Node"]; ?></td>
		<td><?php echo $row["Distance"]; ?></td>
		<td><?php echo $row["Image"]; ?></td>
		<td><a href="update.php?ID=<?php echo $row["ID"]; ?>">Update</a></td>
      </tr>
			<?php
			$i++;
			}
			?>
</table>
 <?php
}
else
{
    echo "No result found for building";
}
//modify edge done
?>

   
    
    <footer>
        <?php
    include 'includes/footer.php';
    ?>
    </footer> 
    </body>

</html>