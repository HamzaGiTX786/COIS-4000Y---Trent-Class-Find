<?php
include 'includes/library.php';

$result = mysqli_query($conn,"SELECT * FROM Node WHERE ID='" . $_GET['ID'] . "'");
$row= mysqli_fetch_array($result);

$ID = $_POST['ID'] ?? null; 
$Location = $_POST['Location'] ?? null;
$Name = $_POST['Name'] ?? null;
$Neighbours= $_POST['Neighbours'] ?? null;
$jsonStore = json_encode($Neighbours);
if(count($_POST)>0) {
    mysqli_query($conn,"UPDATE Node set ID='" . $_POST['ID'] . "', Location='".$Location."', Name='" . $_POST['Name'] . "', Neighbours='" . $jsonStore . "' WHERE ID='" . $_POST['ID'] . "'");
    $message = "Record Modified Successfully";
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
<a href="modify.php">Node List</a>  
<p>--------------------------------------------</p>
<td><a href="delete.php?userid=<?php echo $_GET['ID']; ?>">Delete</a></td>

</div>
ID: <br>
<input type="hidden" name="ID" class="txtField" value="<?php echo $row['ID']; ?>">
<input type="text" name="ID"  value="<?php echo $row['ID']; ?>">
<br>
Location: <br>
<input type="text" name="location" class="txtField" value="<?php echo $row['Location']; ?>">
<br>
Name:<br>
<input type="text" name="Name" class="txtField" value="<?php echo $row['Name']; ?>">
<br>
Neighbours:<br>
<input type="text" name="Neighbours" class="txtField" value="<?php echo json_decode($row['Neighbours']); //try jsondecode the row first ?>">
<br>

<input type="submit" name="submit" value="Submit" class="buttom">

</form>
</body>
</html>