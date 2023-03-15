<?php
include 'includes/library.php';



$result = mysqli_query($conn,"SELECT * FROM Buildings WHERE Code='" . $_GET['ID'] . "'");
$row= mysqli_fetch_array($result);

$oldID = $row['Code']; 
$ID = $_POST['ID'] ?? null; 
$Name = $_POST['Name'] ?? null;
$numroom = $_POST['No_of_rooms'] ?? null;
$geo= $_POST['Geo-location'] ?? null;
if(isset($_POST['submit'])){

$query = "UPDATE Buildings SET Code=?,Name=?,No_of_rooms=?,Geo_location=? WHERE Code=?"; //select the row of the table with the given username
$stmt = mysqli_stmt_init($conn);
echo $ID."\n"; 
echo $Name."\n"; 
echo $numroom."\n"; 
echo $geo."\n";
echo $oldID."\n"; 

if(!mysqli_stmt_prepare($stmt,$query))
{
    echo "SQL prepare failed";
}else{
if(!mysqli_stmt_bind_param($stmt,"sssss",$ID,$Name,$numroom,$geo,$oldID)){
    echo "bind failed";
}
if(!mysqli_stmt_execute($stmt)){
    echo "exec failed";
}
}
}


?>
<html>
<head>
<title>Update Building</title>
</head>
<body>
<form name="frmUser" method="post" action="">
<div><?php if(isset($message)) { echo $message; } ?>
</div>
<div style="padding-bottom:5px;">
<a href="modify.php">Modify List</a>    
<p>--------------------------------------------</p>
<td><a href="deleteBuilding.php?userid=<?php echo $_GET['ID']; ?>">Delete</a></td>

</div>
ID: <br>
<input type="hidden" name="ID" class="txtField" value="<?php echo $row['Code']; ?>">
<input type="text" name="ID"  value="<?php echo $row['Code']; ?>">
<br>
Name: <br>
<input type="text" name="Name" class="txtField" value="<?php echo $row['Name']; ?>">
<br>
Number of Rooms:<br>
<input type="number" name="No_of_rooms" class="txtField" value="<?php echo $row['No_of_rooms']; ?>">
<br>
Geo-location:<br>
<input type="text" name="Geo-location" class="txtField" value="<?php echo ($row['Geo_location']); //try jsondecode the row first ?>">
<br>

<button type="submit" name="submit" class="buttom">Submit</button>

</form>
</body>
</html>