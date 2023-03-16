<?php
include 'includes/library.php';

$querynodes = "SELECT * FROM Node";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$querynodes))
{
    echo "SQL prepare failed";
}else{
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$Node = mysqli_fetch_all($result); // get output for the searched item
}

$queryroom = "SELECT * FROM Room";
$stmtroom = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmtroom,$queryroom))
{
    echo "SQL prepare failed";
}else{
mysqli_stmt_execute($stmtroom);
$result_room = mysqli_stmt_get_result($stmtroom);
$Rooms = mysqli_fetch_all($result_room); // get output for the searched item
}

$querybuild = "SELECT * FROM Buildings";
$stmtbuild = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmtbuild,$querybuild))
{
    echo "SQL prepare failed";
}else{
mysqli_stmt_execute($stmtbuild);
$result_build = mysqli_stmt_get_result($stmtbuild);
$Buildings = mysqli_fetch_all($result_build); // get output for the searched item
}

$queryedge = "SELECT * FROM Edge";
$stmtedge = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmtedge,$queryedge))
{
    echo "SQL prepare failed";
}else{
mysqli_stmt_execute($stmtedge);
$result_edge = mysqli_stmt_get_result($stmtedge);
$Edges = mysqli_fetch_all($result_edge); // get output for the searched item
}


?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/master.css"/>
    <script src="https://kit.fontawesome.com/e156dbae2b.js" crossorigin="anonymous"></script>

    <title>Admin Backend:Trent Class Find</title>
</head>
<body>
<a href="index.php"><?php
        include 'includes/header.php';
    ?></a>
    <div class="navmain">
    <?php
        include 'includes/nav.php';
    ?>
	<main>
		<form >
	<div>
	<h2>Nodes</h2>
		<?php if (sizeof($Node) > 0) :?>
		<table>
			<tr>
				<th>ID</th>
				<th>Location</th>
				<th>Name</th>
				<th>Neighbours</th>
				<th>Action</th>
			</tr>

			<?php foreach($Node as $row): ?>
			<tr>
				<td><?php echo $row[0]; ?></td>
				<td><?php echo $row[1]; ?></td>
				<td><?php echo $row[2]; ?></td>
				<td><?php echo $row[3];?></td>
				<td><?php echo $row[4]; ?></td>
				<td><a href="update.php?ID=<?php echo $row[0]; ?>">Update</a></td>
			</tr>
				<?php endforeach; ?>
		</table>
	<?php else : ?>
		No result found for Nodes
	<?php endif; ?>
	</div>

	<div>
	<h2>Room</h2>
<?php if (sizeof($Rooms) > 0) :?>

<table>
	  <tr>
	    <th>ID</th>
		<th>Building Code</th>
		<th>Name</th>
		<th>Type</th>
		<th>Image</th>
        <th>Action</th>
		
	  </tr>
			
	<?php foreach($Rooms as $row) :?>
	  <tr>
		<td><?php echo $row[0]; ?></td>
		<td><?php echo $row[1]; ?></td>
		<td><?php echo $row[2]; ?></td>
		<td><?php echo $row[3]; ?></td>
		<td><?php echo $row[4]; ?></td>
		<td><a href="update.php?ID=<?php echo $row[0]; ?>">Update</a></td>
      </tr>

		<?php endforeach; ?>
</table>

	<?php else : ?>
	No result found for Room
	<?php endif; ?>

</div>

<div>
	<h2>Building</h2>
	<?php  if (sizeof($Buildings) > 0) :?>
	<table>
		<tr>
			<th>Code</td>
			<td>Name</td>
			<td>Number of Rooms</td>
			<td>Geo-location</td>
			<td>Action</td>
		</tr>

			<?php foreach($Buildings as $row):?>
		<tr>
			<td><?php echo $row[0]; ?></td>
			<td><?php echo $row[1]; ?></td>
			<td><?php echo $row[2]; ?></td>
			<td><?php echo $row[3]; ?></td>
			<td><a href="update.php?ID=<?php echo $row[0]; ?>">Update</a></td>
		</tr>
			<?php endforeach; ?>
	</table>

 	<?php else: ?>
     No result found for building
	<?php endif; ?>
</div>

<div>
<h2>Route</h2>
<?php if (sizeof($Edges) > 0) : ?>

<table>
	  <tr>
	    <th>ID</th>
		<th>Start Node</th>
		<th>End Node</th>
		<th>Description</th>
		<th>Distance</th>
		<th>Images</th>
        <th>Action</th>
	  </tr>

		<?php foreach($Edges as $row) : ?>
	  <tr>
		<td><?php echo $row[0]; ?></td>
		<td><?php echo $row[1]; ?></td>
		<td><?php echo $row[2]; ?></td>
		<td><?php echo $row[3]; ?></td>
		<td><?php echo $row[4]; ?></td>
		<td><?php echo $row[5]; ?></td>
		<td><a href="update.php?ID=<?php echo $row[0]; ?>">Update</a></td>
      </tr>
			<?php endforeach; ?>
</table>
 <?php else: ?>
   No result found for building
<?php endif; ?>
</div>
</form>
</main>
	</div>
    <footer>
        <?php include 'includes/footer.php'; ?>
    </footer> 
    </body>
</html>