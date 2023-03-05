<?php
include 'includes/library.php';
$result = mysqli_query($conn,"SELECT * FROM Node");
?>
<!DOCTYPE html>
<html>
 <head>
 <title> Retrive data</title>
 </head>
<body>
<?php
if (mysqli_num_rows($result) > 0) {
?>
  <table>
  <tr>
    <td>ID</td>
    <td>Location</td>
    <td>Name</td>
    <td>Neighbours</td>
  </tr>
<?php
$i=0;
while($row = mysqli_fetch_array($result)) {
?>
<tr>
    <td><?php echo $row["ID"]; ?></td>
    <td><?php echo $row["Location"]; ?></td>
    <td><?php echo $row["Name"]; ?></td>
    <td><?php echo $row["Neighbours"]; ?></td>
</tr>
<?php
$i++;
}
?>
</table>
 <?php
}
else{
    echo "No result found";
}
?>
 </body>
</html>