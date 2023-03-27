<?php
include 'includes/library.php';

if(!isset($_POST['submit'])){

if(!isset($_GET['Room_Code'])){
    header("Location: modify");
    die();
}

$room_code = $_GET['Room_Code'];
$inroom = false;

if(strstr($room_code,"SELECT") || strstr($room_code, "UPDATE") || strstr($room_code,"DELETE") || strstr($room_code,"DROP"))
{
    header("Location: modify");
    die();
}

$q = "SELECT RoomCode FROM Room";
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

$query= "SELECT Code,Name FROM Buildings";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$query))
{
    echo "SQL prepare failed";
}
else{
    mysqli_stmt_execute($stmt);
    $result_build = mysqli_stmt_get_result($stmt);
    $buildings = mysqli_fetch_all($result_build); // get output for the searched item
}

$query = "SELECT * FROM Room WHERE RoomCode= ?";
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
}
else{
$oldID = $row['RoomCode']; 
$ID = $_POST['newID'] ?? null; 
$Building_code = $_POST['Building_code'] ?? null;
$Name = $_POST['Name'] ?? null;
$Type= $_POST['Type'] ?? null;


$query = "UPDATE Room SET RoomCode=?,Building_code=?,Name=?,Type=? WHERE RoomCode=?"; //select the row of the table with the given username
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
    <script src="scripts/update_room_script.js" crossorigin="anonymous"></script>
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
        <a href="deleteRoom.php?room_ID=<?php echo  $row['RoomCode']; ?>">Delete</a>
        </div>

        <div class="start">
        <label for="newID">Room Code:</label>
        <input type="text" name="newID"  value="<?php echo $row['RoomCode']; ?>">
        <input type="text" class="hidden" name="oldID"  value="<?= $row['RoomCode']; ?>">
        </div>


        <div class="start">
        <label for="Building_code">Building_code:</label>
        <select name="Building_code" id="Building_code" value="<?= $row['Building_code'];?>" required>
            <option value="<?=$row['Building_code']?>;"><?php foreach($buildings as $build){if(in_array($row['Building_code'],$build)){ echo $build[1];}}?></option>
            <?php foreach($buildings as $build): ?>
            <option value="<?=$build[0]?>"><?=$build[1]?></option>
        <?php endforeach; ?>
        </select>
        </div>


        <div class="start">
        <label for="Name">Name:</label>
        <input type="text" name="Name" value="<?php echo $row['Name']; ?>">
        </div>


        <div class="start">
        <label for="Type">Type:</label>
        <select name="Room_Type" id="Room_Type">
            <option value="<?= $row['Type']?>"><?php switch($row['Type']){case "Seminar": echo "Seminar Room"; break; case "Lecture": echo "Lecture Hall"; break; case "Study": echo "Individual Study Room"; break; case "Group": echo "Group Study Room"; break; case "Commons": echo "College Commons"; break;} ?></option>
            <option value="Seminar">Seminar Room</option>
            <option value="Lecture">Lecture Hall</option>
            <option value="Study">Individual Study Room</option>
            <option value="Group">Group Study Room</option>
            <option value="Commons">College Commons</option>
        </select>
        </div>

        <div class="start">
            <label for="room_images">Image(s)</label>
            <?php $images = explode(",", $row['Image']);?>
        <ol>
         <?php foreach($images as $i): ?> 
            <li>
                <div>
                    <?= $i;?>
                </div>
                <div class="trash">
                    <i class="fa-solid fa-trash"></i>
                </div>
            </li>
        <?php endforeach; ?>
        </ol>
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