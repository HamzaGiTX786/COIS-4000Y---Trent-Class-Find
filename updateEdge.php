<?php
include 'includes/library.php';



$result = mysqli_query($conn,"SELECT * FROM Edge WHERE ID='" . $_GET['ID'] . "'"); 
$row= mysqli_fetch_array($result);

$oldID = $row['ID']; 
$ID = $_POST['newID'] ?? null; 
$Start_Node = $_POST['Start_Node'] ?? null;
$End_Node = $_POST['End_Node'] ?? null;
$Description= $_POST['Description'] ?? null;
$Distance= $_POST['Distance'] ?? null;

if(isset($_POST['submit'])){

$query = "UPDATE Edge SET ID=?,Start_Node=?,End_Node=?,Description=?,Distance=? WHERE ID=?"; //select the row of the table with the given username
$stmt = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$query))
{
    echo "SQL prepare failed";
}else{
if(!mysqli_stmt_bind_param($stmt,"ssssss",$ID,$Start_Node,$End_Node,$Description,$Distance,$oldID)){
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
<title>Update Route</title>
</head>
<body>
<form name="frmUser" method="post" action="">
<div><?php if(isset($message)) { echo $message; } ?>
</div>
<div style="padding-bottom:5px;">
<a href="modify.php">Modify List</a>    
<p>--------------------------------------------</p>
<td><a href="deleteEdge.php?userid=<?php echo $_GET['ID']; ?>">Delete</a></td>

</div>
ID: <br>
<input type="hidden" name="newID" class="txtField" value="<?php echo $row['ID']; ?>">
<input type="text" name="newID"  value="<?php echo $row['ID']; ?>">
<br>
Start Node: <br>
<input type="text" name="Start_Node" class="txtField" value="<?php echo $row['Start_Node']; ?>">
<br>
End Node:<br>
<input type="text" name="End_Node" class="txtField" value="<?php echo $row['End_Node']; ?>">
<br>
Description:<br>
<input type="number" name="Description" class="txtField" value="<?php echo ($row['Description']); //try jsondecode the row first ?>">
<br>
<br>
Distance:<br>
<input type="number" name="Distance" class="txtField" value="<?php echo ($row['Distance']); //try jsondecode the row first ?>">
<br>

<button type="submit" name="submit" class="buttom">Submit</button>

</form>
</body>
</html>