<?php
include 'includes/library.php';



$result = mysqli_query($conn,"SELECT * FROM Node WHERE ID='" . $_GET['ID'] . "'"); 
$row= mysqli_fetch_array($result);

$oldID = $row['ID']; 
$ID = $_POST['newID'] ?? null; 
$Location = $_POST['Location'] ?? null;
$Name=$_POST['Name'] ?? null;
$Building_code=$_POST['Building_code'] ?? null;
$Neighbours=$_POST['Neighbours'] ?? null;
$json=json_encode($Neighbours); 


echo $Location;
if(isset($_POST['submit'])){

$query = "UPDATE Node SET ID=?,Location=?,Name=?,Building_code=?,Neighbours=? WHERE ID=?"; //select the row of the table with the given username
$stmt = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$query))
{
    echo "SQL prepare failed";
}else{
if(!mysqli_stmt_bind_param($stmt,"ssssss",$ID,$Location,$Name,$Building_code,$json,$oldID)){
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
<title>Update Node</title>
</head>
<body>
<form name="frmUser" method="post" action="">
<div><?php if(isset($message)) { echo $message; } ?>
</div>
<div style="padding-bottom:5px;">
<a href="modify.php">Modify List</a>    
<p>--------------------------------------------</p>
<td><a href="delete.php?userid=<?php echo $_GET['ID']; ?>">Delete</a></td>

</div>
ID: <br>
<input type="hidden" name="newID" class="txtField" value="<?php echo $row['ID']; ?>">
<input type="text" name="newID"  value="<?php echo $row['ID']; ?>"> 
<br>
Location: <br>
<input type="text" name="Location" class="txtField" value="<?php echo $row['Location']; ?>">
<br>
Name: <br>
<input type="text" name="Name" class="txtField" value="<?php echo $row['Name']; ?>">
<br>
Building code: <br>
<input type="text" name="Building_code" class="txtField" value="<?php echo $row['Building_code']; ?>">
<br>
Neighbours: <br>
<input type="text" name="Neighbours" class="txtField" value="<?php echo json_decode($row['Neighbours']); ?>">
<br>

<button type="submit" name="submit" class="buttom">Submit</button>

</form>
</body>
</html>