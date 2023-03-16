<?php
include 'includes/library.php';



$result = mysqli_query($conn,"SELECT * FROM Room WHERE ID='" . $_GET['ID'] . "'"); 
$row= mysqli_fetch_array($result);

$oldID = $row['ID']; 
$ID = $_POST['newID'] ?? null; 
$Building_code = $_POST['Building_code'] ?? null;
$Name = $_POST['Name'] ?? null;
$Type= $_POST['Type'] ?? null;
if(isset($_POST['submit'])){

$query = "UPDATE Room SET ID=?,Building_code=?,Name=?,Type=? WHERE ID=?"; //select the row of the table with the given username
$stmt = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$query))
{
    echo "SQL prepare failed";
}else{
if(!mysqli_stmt_bind_param($stmt,"sssss",$ID,$Building_code,$Name,$Type,$oldID)){
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
<title>Update Room</title>
</head>
<body>
<form name="frmUser" method="post" action="">
<div><?php if(isset($message)) { echo $message; } ?>
</div>
<div style="padding-bottom:5px;">
<a href="modify.php">Modify List</a>    
<p>--------------------------------------------</p>
<td><a href="deleteRoom.php?userid=<?php echo $_GET['ID']; ?>">Delete</a></td>

</div>
ID: <br>
<input type="hidden" name="newID" class="txtField" value="<?php echo $row['ID']; ?>">
<input type="text" name="newID"  value="<?php echo $row['ID']; ?>">
<br>
Building Code: <br>
<input type="text" name="Building_code" class="txtField" value="<?php echo $row['Building_code']; ?>">
<br>
Name:<br>
<input type="text" name="Name" class="txtField" value="<?php echo $row['Name']; ?>">
<br>
Type:<br>
<input type="number" name="Type" class="txtField" value="<?php echo ($row['Type']); //try jsondecode the row first ?>">
<br>

<button type="submit" name="submit" class="buttom">Submit</button>

</form>
</body>
</html>