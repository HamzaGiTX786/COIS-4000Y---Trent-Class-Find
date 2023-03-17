<?php
include 'includes/library.php';

if(!isset($_GET['ID'])){
    header("Location: modify");
    die();
}

$room_code = $_GET['ID'];
$inroom = false;

if(strstr($room_code,"SELECT") || strstr($room_code, "UPDATE") || strstr($room_code,"DELETE") || strstr($room_code,"DROP"))
{
    header("Location: modify");
    die();
}

$q = "SELECT ID FROM Room ORDER BY Name ASC";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$q))
{
    echo "SQL prepare failed";
}
else{
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rooms = mysqli_fetch_all($result); // get output for the searched item
}

foreach($rooms as $r){
    if($room_code == $r[0])
    {
        $inroom = true;
    }
}

if($inroom === false){
    header("Location: modify");
    die();
}

$query = "SELECT * FROM Room WHERE ID= ?";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$query))
{
    echo "SQL prepare failed";
}
else{
    if(!mysqli_stmt_bind_param($stmt,"s",$room_code)){
        echo "bind failed"; 
    } 
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result); // get output for the searched item
}

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
<form name="updateroom" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">

        <div>
            <?php if(isset($message)) { echo $message; } ?> 
        </div>

        <div>
        <a href="modify.php">Modify List</a>    
        <a href="deleteRoom.php?userid=<?php echo $room_code; ?>">Delete</a>
        </div>

        <div class="start">
        <label for="newID">New ID:</label>
        <input type="text" name="newID"  value="<?php echo $row['ID']; ?>">
        </div>


        <div class="start">
        <label for="Building_code">Building_code:</label>
        <input type="text" name="Building_code" value="<?php echo $row['Building_code']; ?>">
        </div>


        <div class="start">
        <label for="Name">Name:</label>
        <input type="text" name="Name" value="<?php echo $row['Name']; ?>">
        </div>


        <div class="start">
        <label for="Type">Type:</label>
        <input type="number" name="Type" value="<?php echo ($row['Type']); ?>">
        </div>

        <div id="buttons">    
        <button type="submit" name="submit">Update Building</button>
        </div>

</form>
</main>
</div>
<?php include "includes/footer.php"; ?>
</body>
</html>